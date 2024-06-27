<?php
require_once('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$suggestion_id = $data['id'];

$conn = db_connect();
$stmt = $conn->prepare("DELETE FROM movie_suggestions WHERE id = ?");
$stmt->bind_param('i', $suggestion_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete suggestion']);
}

$stmt->close();
$conn->close();
?>
