<?php
require_once('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$title_id = $_POST['title_id'];
$user_id = $_SESSION['user_id'];
$suggestion = $_POST['suggestion'];

$conn = db_connect();

$stmt = $conn->prepare("INSERT INTO movie_suggestions (title_id, user_id, suggestion) VALUES (?, ?, ?)");
$stmt->bind_param('iis', $title_id, $user_id, $suggestion);
$stmt->execute();

echo json_encode(['success' => true]);

$stmt->close();
$conn->close();
?>
