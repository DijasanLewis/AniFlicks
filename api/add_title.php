<?php
require_once('../includes/config.php');

$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $release_date = $_POST['release_date'];
    $genre = $_POST['genre'];
    $writer = $_POST['writer'];
    $studio = $_POST['studio'];
    $poster_path = $_FILES['poster_path'];
    $background_path = $_FILES['background_path'];
    $trailer_link = $_POST['trailer_link'];
    $sinopsis = $_POST['sinopsis'];
    $description = $_POST['description'];

    $target_dir = "../assets/images/";
    $poster_target_file = $target_dir . basename($poster_path["name"]);
    $background_target_file = $target_dir . basename($background_path["name"]);

    // Move uploaded files
    if (move_uploaded_file($poster_path["tmp_name"], $poster_target_file) && move_uploaded_file($background_path["tmp_name"], $background_target_file)) {
        $conn = db_connect();

        if ($_SESSION['is_admin']) {
            // Insert directly into titles table for admin
            $stmt = $conn->prepare("INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis, description, approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
            $stmt->bind_param("sdsssssssss", $name, $rating, $release_date, $genre, $writer, $studio, $poster_target_file, $background_target_file, $trailer_link, $sinopsis, $description);
        } else {
            // Insert into temporary_titles table for regular users
            $stmt = $conn->prepare("INSERT INTO temporary_titles (user_id, name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isdsssssssss", $user_id, $name, $rating, $release_date, $genre, $writer, $studio, $poster_target_file, $background_target_file, $trailer_link, $sinopsis, $description);
        }

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Title added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add title.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload files.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
