<?php
include('../includes/movie_function.php'); // Load fungsi-fungsi film

$title_id = $_POST['title_id'];
$name = $_POST['name'];
$rating = $_POST['rating'];
$release_date = $_POST['release_date'];
$genre = $_POST['genre'];
$writer = $_POST['writer'];
$studio = $_POST['studio'];
$description = $_POST['description'];

// Menyimpan perubahan di tabel temporary_titles
$query = "INSERT INTO temporary_titles (title_id, name, rating, release_date, genre, writer, studio, description, suggested_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('isisssssi', $title_id, $name, $rating, $release_date, $genre, $writer, $studio, $description, $_SESSION['user_id']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Suggestion submitted successfully";
} else {
    echo "Failed to submit suggestion";
}
$stmt->close();
$conn->close();
?>
