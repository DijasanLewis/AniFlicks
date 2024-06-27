<?php
include('../includes/config.php');
session_start();

header('Content-Type: application/json');

// Memeriksa apakah pengguna adalah admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

// Mengambil title_id dari permintaan POST
$data = json_decode(file_get_contents('php://input'), true);
$title_id = $data['title_id'] ?? null;

if (!$title_id) {
    echo json_encode(['success' => false, 'message' => 'Title ID is missing']);
    exit();
}

// Menghubungkan ke database
$conn = db_connect();

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Menghapus film dari tabel titles
$stmt = $conn->prepare("DELETE FROM titles WHERE title_id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Statement preparation failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param('i', $title_id);
$success = $stmt->execute();

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete movie: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
