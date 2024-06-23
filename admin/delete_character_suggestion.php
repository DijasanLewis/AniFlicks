<?php
include('../includes/config.php');
session_start();

header('Content-Type: application/json');

// Memeriksa apakah pengguna adalah admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

// Mengambil suggestion_id dari permintaan POST
$data = json_decode(file_get_contents('php://input'), true);
$suggestion_id = $data['suggestion_id'] ?? null;

if (!$suggestion_id) {
    echo json_encode(['success' => false, 'message' => 'Suggestion ID is missing']);
    exit();
}

// Menghubungkan ke database
$conn = db_connect();

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Menghapus saran karakter dari tabel temporary_characters
$stmt = $conn->prepare("DELETE FROM temporary_characters WHERE id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Statement preparation failed']);
    exit();
}

$stmt->bind_param('i', $suggestion_id);
$success = $stmt->execute();

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete suggestion']);
}

$stmt->close();
$conn->close();
?>
