<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Not logged in', 'success' => false]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title_id'], $_POST['new_status'])) {
    $title_id = $_POST['title_id'];
    $new_status = $_POST['new_status'];
    $user_id = $_SESSION['user_id'];

    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE watchlist SET watched = ? WHERE title_id = ? AND user_id = ?");
    $stmt->bind_param("sii", $new_status, $title_id, $user_id);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Berhasil Mengubah Status', 'success' => true]);
    } else {
        echo json_encode(['message' => 'Gagal Mengubah Status', 'success' => false]);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['message' => 'Invalid request', 'success' => false]);
}
?>
