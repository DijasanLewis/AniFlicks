include('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$title_id = $_POST['title_id'];
$character_ids = $_POST['character_id'];
$character_names = $_POST['character_name'];
$character_images = $_FILES['character_image'];
$current_image_paths = $_POST['current_image_path'];
$delete_character_ids = $_POST['delete_character_id'] ?? [];

$conn = db_connect();

foreach ($character_ids as $index => $character_id) {
    if (in_array($character_id, $delete_character_ids)) {
        // Hapus karakter dari database
        $stmt = $conn->prepare("DELETE FROM characters WHERE character_id = ?");
        $stmt->bind_param('i', $character_id);
        $stmt->execute();
        $stmt->close();
        continue;
    }

    $name = $character_names[$index];
    $current_image_path = $current_image_paths[$index];
    $image_path = $current_image_path;

    if ($character_images['tmp_name'][$index]) {
        $image_path = '../assets/images/temporary/characters/' . basename($character_images['name'][$index]);
        move_uploaded_file($character_images['tmp_name'][$index], $image_path);
    }

    if ($character_id === "new") {
        $stmt = $conn->prepare("INSERT INTO characters (title_id, name, image_path) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $title_id, $name, $image_path);
    } else {
        $stmt = $conn->prepare("UPDATE characters SET name=?, image_path=? WHERE character_id=?");
        $stmt->bind_param('ssi', $name, $image_path, $character_id);
    }
    $stmt->execute();
}

$conn->close();

echo json_encode(['success' => true]);
