<?php
require_once('../includes/config.php');

if (!$_SESSION['is_admin']) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? 0;

if ($id) {
    $conn = db_connect();
    $sql = "SELECT * FROM temporary_titles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $stmt_insert = $conn->prepare("INSERT INTO titles (name, rating, release_date, genre, writer, studio, poster_path, background_path, trailer_link, sinopsis, description, approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
        $stmt_insert->bind_param("sdsssssssss", $row['name'], $row['rating'], $row['release_date'], $row['genre'], $row['writer'], $row['studio'], $row['poster_path'], $row['background_path'], $row['trailer_link'], $row['sinopsis'], $row['description']);

        if ($stmt_insert->execute()) {
            $stmt_delete = $conn->prepare("DELETE FROM temporary_titles WHERE id = ?");
            $stmt_delete->bind_param('i', $id);
            $stmt_delete->execute();
            $stmt_delete->close();

            echo json_encode(['success' => true, 'message' => 'Title approved successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to approve title.']);
        }

        $stmt_insert->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Title not found.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
}
?>
