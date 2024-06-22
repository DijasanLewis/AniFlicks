<?php
include('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$title_id = $_GET['title_id'];

$conn = db_connect();

$stmt = $conn->prepare("SELECT * FROM temporary_characters WHERE title_id = ?");
$stmt->bind_param("i", $title_id);
$stmt->execute();
$suggestions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'suggestions' => $suggestions]);
?>
