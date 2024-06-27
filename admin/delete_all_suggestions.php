<?php
require_once('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$title_id = $data['title_id'];

$conn = db_connect();
$stmt = $conn->prepare("DELETE FROM movie_suggestions WHERE title_id = ?");
$stmt->bind_param('i', $title_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete suggestions']);
}

$stmt->close();
$conn->close();
?>
