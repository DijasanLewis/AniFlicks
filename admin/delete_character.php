<?php
include('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$character_id = $data['character_id'];

if (!$character_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid character ID']);
    exit();
}

$conn = db_connect();

$stmt = $conn->prepare("DELETE FROM characters WHERE character_id = ?");
$stmt->bind_param("i", $character_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Character not found']);
}

$stmt->close();
$conn->close();
?>
