<?php
require_once '../includes/config.php';

// Cek apakah user telah login
check_login();

$response = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari body request
    $data = json_decode(file_get_contents('php://input'), true);
    $title_id = $data['title_id'];
    $user_id = $_SESSION['user_id']; 

    // Koneksi ke database
    $conn = db_connect();

    // Periksa apakah judul sudah ada dalam watchlist
    $check = $conn->prepare("SELECT * FROM watchlist WHERE title_id = ? AND user_id = ?");
    $check->bind_param("ii", $title_id, $user_id);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows == 0) {
        // Tambahkan ke database jika belum ada
        $stmt = $conn->prepare("INSERT INTO watchlist (user_id, title_id, watched) VALUES (?, ?, 'Akan Ditonton')");
        $stmt->bind_param("ii", $user_id, $title_id);
        $stmt->execute();
        $stmt->close();
        $response['message'] = "Berhasil ditambahkan ke daftar tontonan!";
        $response['status'] = 'success';
    } else {
        $response['message'] = "Sudah ada di daftar tontonan!";
        $response['status'] = 'info';
    }

    $conn->close();
} else {
    $response['message'] = "Invalid request.";
    $response['status'] = 'error';
}

header('Content-Type: application/json');
echo json_encode($response);
?>