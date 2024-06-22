<?php
include('../includes/config.php');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$title_id = $_POST['title_id'];
$user_id = $_SESSION['user_id'];
$character_names = $_POST['character_name'];
$character_images = $_FILES['character_image'];

$conn = db_connect();

foreach ($character_names as $index => $name) {
    $image_path = null;

    if ($character_images['tmp_name'][$index]) {
        $image_path = '../assets/images/temporary/characters/' . basename($character_images['name'][$index]);
        move_uploaded_file($character_images['tmp_name'][$index], $image_path);
    } else {
        $image_path = $_POST['current_image_path'][$index];
    }

    $stmt = $conn->prepare("INSERT INTO temporary_characters (user_id, title_id, name, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiss', $user_id, $title_id, $name, $image_path);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(['success' => true]);
?>
