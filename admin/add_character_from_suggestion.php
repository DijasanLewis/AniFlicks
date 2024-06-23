<?php
include('../includes/config.php'); // Menghubungkan ke file konfigurasi yang mengandung koneksi database dan pengaturan lainnya

header('Content-Type: application/json'); // Mengatur header agar response yang dikirim adalah JSON

// Memeriksa apakah pengguna adalah admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

// Mengambil data yang dikirim dari permintaan POST dan mendekodenya dari JSON
$data = json_decode(file_get_contents('php://input'), true);
$character_id = $data['character_id'] ?? null;

// Memeriksa apakah character_id ada
if (!$character_id) {
    echo json_encode(['success' => false, 'message' => 'Character ID is missing']);
    exit();
}

error_log("Character ID: " . $character_id); // Logging untuk debugging

$conn = db_connect(); // Menghubungkan ke database

// Ambil data dari temporary_characters berdasarkan character_id
$stmt = $conn->prepare("SELECT title_id, name, image_path FROM temporary_characters WHERE id = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    echo json_encode(['success' => false, 'message' => 'Prepare failed']);
    exit();
}
$stmt->bind_param('i', $character_id); // Mengikat parameter ke statement SQL
$stmt->execute(); // Menjalankan statement
$result = $stmt->get_result(); // Mendapatkan hasil dari statement
$suggestion = $result->fetch_assoc(); // Mengambil hasil sebagai array asosiatif
$stmt->close(); // Menutup statement

// Memeriksa apakah data saran karakter ditemukan
if ($suggestion) {
    // Menambahkan data ke tabel characters
    $stmt = $conn->prepare("INSERT INTO characters (title_id, name, image_path) VALUES (?, ?, ?)");
    if (!$stmt) {
        error_log("Prepare failed (insert): " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Prepare failed (insert)']);
        exit();
    }
    $stmt->bind_param('iss', $suggestion['title_id'], $suggestion['name'], $suggestion['image_path']); // Mengikat parameter
    $stmt->execute(); // Menjalankan statement
    $stmt->close(); // Menutup statement

    // Menghapus data dari temporary_characters setelah berhasil dimasukkan ke tabel characters
    $stmt = $conn->prepare("DELETE FROM temporary_characters WHERE id = ?");
    if (!$stmt) {
        error_log("Prepare failed (delete): " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Prepare failed (delete)']);
        exit();
    }
    $stmt->bind_param('i', $character_id); // Mengikat parameter
    $stmt->execute(); // Menjalankan statement
    $stmt->close(); // Menutup statement

    echo json_encode(['success' => true]); // Mengirim response sukses
} else {
    error_log("Suggestion not found for ID: " . $character_id); // Logging jika saran tidak ditemukan
    echo json_encode(['success' => false, 'message' => 'Suggestion not found']); // Mengirim response gagal
}

$conn->close(); // Menutup koneksi database
?>
