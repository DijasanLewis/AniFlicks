<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Not logged in', 'success' => false]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title_id'])) {
    $title_id = $_POST['title_id'];
    $user_id = $_SESSION['user_id'];

    $conn = db_connect();
    $stmt = $conn->prepare("DELETE FROM watchlist WHERE title_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $title_id, $user_id);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Title removed from watchlist successfully', 'success' => true]);
    } else {
        echo json_encode(['message' => 'Failed to remove title', 'success' => false]);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['message' => 'Invalid request', 'success' => false]);
}
?>
