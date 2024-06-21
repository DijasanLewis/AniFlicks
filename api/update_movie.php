<?php
include('../includes/movie_function.php');
session_start();

if ($_SESSION['is_admin']) {
    $title_id = $_POST['title_id'];
    $unique_id = generate_unique_id();
    
    // Mengurus file yang diupload dan membuat nama file otomatis
    if ($_FILES['poster_path']['tmp_name']) {
        $poster_filename = $unique_id . '_' . basename($_FILES['poster_path']['name']) . '_poster.png';
        $poster_path = '../assets/images/uploads/posters/' . $poster_filename;
        move_uploaded_file($_FILES['poster_path']['tmp_name'], $poster_path);
    } else {
        $poster_path = $_POST['poster_path'];
    }
    
    if ($_FILES['background_path']['tmp_name']) {
        $background_filename = $unique_id . '_' . basename($_FILES['background_path']['name'], ".png") . '_bg.png';
        $background_path = '../assets/images/uploads/backgrounds/' . $background_filename;
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

    if (update_movie_details($title_id, $data)) {
        header("Location: ../templates/details.php?title_id=$title_id&update_success=1");
    } else {
        header("Location: ../templates/details.php?title_id=$title_id&update_error=1");
    }
} else {
    header("Location: ../index.php");
}
?>
