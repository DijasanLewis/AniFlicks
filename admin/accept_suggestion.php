<?php
require_once('../includes/config.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_suggestion'])) {
    $title_id = $_POST['title_id'];
    $suggestion_id = $_POST['suggestion_id'];

    // Ambil data saran
    $suggestion = get_suggestion_by_id($suggestion_id);

    // Perbarui data di tabel titles
    $data = [
        'name' => $_POST['name'],
        'rating' => $_POST['rating'],
        'release_date' => $_POST['release_date'],
        'genre' => $_POST['genre'],
        'writer' => $_POST['writer'],
        'studio' => $_POST['studio'],
        'poster_path' => $suggestion['poster_path'],
        'background_path' => $suggestion['background_path'],
        'trailer_link' => $_POST['trailer_link'],
        'sinopsis' => $suggestion['sinopsis'],
        'description' => $suggestion['description']
    ];

    if (update_movie_details($title_id, $data)) {
        // Hapus saran setelah diterima
        delete_suggestion($suggestion_id);
        header("Location: ../templates/details.php?title_id=$title_id&update_success=1");
    } else {
        header("Location: ../templates/details.php?title_id=$title_id&update_error=1");
    }
}

function get_suggestion_by_id($id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM temporary_titles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $suggestion = $result->fetch_assoc();
    $stmt->close();
    return $suggestion;
}

function delete_suggestion($id) {
    $conn = db_connect();
    $stmt = $conn->prepare("DELETE FROM temporary_titles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function update_movie_details($title_id, $data) {
    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE titles SET name=?, rating=?, release_date=?, genre=?, writer=?, studio=?, poster_path=?, background_path=?, trailer_link=?, sinopsis=?, description=? WHERE title_id=?");
    $stmt->bind_param(
        "sdsssssssssi",
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
        $data['description'],
        $title_id
    );
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
?>
