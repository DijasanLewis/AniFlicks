<?php
require_once 'config.php';
$conn = db_connect();

$query = $_GET['query'] ?? '';

// Hindari SQL Injection
$stmt = $conn->prepare("
    SELECT DISTINCT titles.title_id, titles.poster_path, titles.name, YEAR(titles.release_date) AS year, titles.genre
    FROM titles
    LEFT JOIN characters ON titles.title_id = characters.title_id
    WHERE titles.name LIKE CONCAT('%', ?, '%') OR
          characters.name LIKE CONCAT('%', ?, '%') OR
          titles.writer LIKE CONCAT('%', ?, '%') OR
          titles.genre LIKE CONCAT('%', ?, '%')
    ORDER BY titles.name ASC
    LIMIT 10
");

$stmt->bind_param('ssss', $query, $query, $query, $query);
$stmt->execute();
$result = $stmt->get_result();

$titles = [];
while ($row = $result->fetch_assoc()) {
    $titles[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($titles);
?>
