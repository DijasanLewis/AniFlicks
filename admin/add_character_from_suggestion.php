<?php
include('../includes/config.php');
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$character_id = $_POST['character_id'];

$conn = db_connect();

// Ambil data dari temporary_characters
$stmt = $conn->prepare("SELECT title_id, name, image_path FROM temporary_characters WHERE id = ?");
$stmt->bind_param('i', $character_id);
$stmt->execute();
$result = $stmt->get_result();
$suggestion = $result->fetch_assoc();
$stmt->close();

if ($suggestion) {
    // Masukkan data ke tabel characters
    $stmt = $conn->prepare("INSERT INTO characters (title_id, name, image_path) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $suggestion['title_id'], $suggestion['name'], $suggestion['image_path']);
    $stmt->execute();
    $stmt->close();

    // Hapus dari temporary_characters setelah dimasukkan ke characters
    $stmt = $conn->prepare("DELETE FROM temporary_characters WHERE id = ?");
    $stmt->bind_param('i', $character_id);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Suggestion not found']);
}

$conn->close();
?>
