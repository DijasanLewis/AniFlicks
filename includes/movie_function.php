<?php
include('config.php'); // Memastikan file konfigurasi di-load

function get_movie_details($title_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM titles WHERE title_id = ?");
    $stmt->bind_param("i", $title_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

function get_movie_characters($title_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM characters WHERE title_id = ?");
    $stmt->bind_param("i", $title_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

function get_movie_reviews($title_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT reviews.*, users.username FROM reviews JOIN users ON reviews.user_id = users.user_id WHERE title_id = ?");
    $stmt->bind_param("i", $title_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

function is_movie_in_watchlist($user_id, $title_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM watchlist WHERE user_id = ? AND title_id = ?");
    $stmt->bind_param("ii", $user_id, $title_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function update_movie_rating($user_id, $title_id, $rating) {
    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE watchlist SET rating = ? WHERE user_id = ? AND title_id = ?");
    $stmt->bind_param("iii", $rating, $user_id, $title_id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
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
    return $stmt->execute();
}

function generate_unique_id() {
    return uniqid();
}


?>
