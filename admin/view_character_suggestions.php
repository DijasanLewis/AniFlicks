<?php
include('../includes/config.php');

header('Content-Type: application/json');

$title_id = $_GET['title_id'];

$conn = db_connect();

$stmt = $conn->prepare("SELECT id, name, image_path FROM temporary_characters WHERE title_id = ?");
$stmt->bind_param('i', $title_id);
$stmt->execute();
$result = $stmt->get_result();
$suggestions = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'suggestions' => $suggestions]);
?>
