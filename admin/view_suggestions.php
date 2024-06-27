<?php
require_once('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$title_id = $_GET['title_id'];

$conn = db_connect();
$stmt = $conn->prepare("SELECT ms.*, u.username FROM movie_suggestions ms JOIN users u ON ms.user_id = u.user_id WHERE ms.title_id = ?");
$stmt->bind_param('i', $title_id);
$stmt->execute();
$result = $stmt->get_result();

$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row;
}

echo json_encode(['success' => true, 'suggestions' => $suggestions]);
$stmt->close();
$conn->close();
?>
