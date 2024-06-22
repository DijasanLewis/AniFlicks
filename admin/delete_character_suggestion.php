<?php
include('../includes/config.php');
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$suggestion_id = $_POST['suggestion_id'];

$conn = db_connect();

$stmt = $conn->prepare("DELETE FROM temporary_characters WHERE id = ?");
$stmt->bind_param('i', $suggestion_id);
$success = $stmt->execute();
$stmt->close();

$conn->close();

echo json_encode(['success' => $success]);
?>
