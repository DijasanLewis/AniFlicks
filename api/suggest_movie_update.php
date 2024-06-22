<?php
include('../includes/config.php');

function suggest_update_movie_details($title_id, $data) {
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO temporary_titles (title_id, user_id, name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "iisdsssssssss",
        $title_id,
        $_SESSION['user_id'], // Add user_id here
        $data['name'],
        $data['rating'],
        $data['release_date'],
        $data['genre'],
        $data['writer'],
        $data['studio'],
        $data['poster_path'],
        $data['background_path'],
        $data['trailer_link'],
        $data['sinopsis'],
        $data['description']
    );
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

$title_id = $_POST['title_id'];
$unique_id = uniqid();

// Mengurus file yang diupload dan membuat nama file otomatis
if ($_FILES['poster_path']['tmp_name']) {
    $poster_filename = $unique_id . '_' . basename($_FILES['poster_path']['name'], ".png") . '_poster.png';
    $poster_path = '../assets/images/temporary/posters/' . $poster_filename;
    move_uploaded_file($_FILES['poster_path']['tmp_name'], $poster_path);
} else {
    $poster_path = $_POST['poster_path'];
}

if ($_FILES['background_path']['tmp_name']) {
    $background_filename = $unique_id . '_' . basename($_FILES['background_path']['name'], ".png") . '_bg.png';
    $background_path = '../assets/images/temporary/backgrounds/' . $background_filename;
    move_uploaded_file($_FILES['background_path']['tmp_name'], $background_path);
} else {
    $background_path = $_POST['background_path'];
}

$data = [
    'name' => $_POST['name'],
    'rating' => $_POST['rating'],
    'release_date' => $_POST['release_date'],
    'genre' => $_POST['genre'],
    'writer' => $_POST['writer'],
    'studio' => $_POST['studio'],
    'poster_path' => $poster_path,
    'background_path' => $background_path,
    'trailer_link' => $_POST['trailer_link'],
    'sinopsis' => $_POST['sinopsis'],
    'description' => $_POST['description']
];

if (suggest_update_movie_details($title_id, $data)) {
    header("Location: ../templates/details.php?title_id=$title_id&suggest_update_success=1");
} else {
    header("Location: ../templates/details.php?title_id=$title_id&suggest_update_error=1");
}


?>
