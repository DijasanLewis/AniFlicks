<?php
require_once('../includes/config.php');

if (!$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? 0;

if ($id) {
    $conn = db_connect();
    $stmt = $conn->prepare("DELETE FROM temporary_titles WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Title deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete title.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
}
?>
