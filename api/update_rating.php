<?php
include('../includes/movie_function.php');

$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title_id = $_POST['title_id'];
    $rating = $_POST['rating'];

    if ($user_id && $title_id && $rating) {
        if (update_movie_rating($user_id, $title_id, $rating)) {
            echo json_encode(['success' => true, 'message' => 'Rating updated!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update rating.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
