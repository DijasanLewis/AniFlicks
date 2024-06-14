<?php
require_once 'config.php';
$conn = db_connect();

$query = $_GET['query'] ?? '';  // Ambil nilai pencarian dari URL parameter

// Untuk pencarian berdasarkan tahun (2 -> 2002, 2020, dst.)
$search_year = $query . '%';

$stmt = $conn->prepare("
    SELECT DISTINCT titles.title_id, titles.poster_path, titles.name, YEAR(titles.release_date) AS year, titles.genre
    FROM titles
    LEFT JOIN characters ON titles.title_id = characters.title_id
    WHERE (titles.name LIKE CONCAT('%', ?, '%') OR
           characters.name LIKE CONCAT('%', ?, '%') OR
           titles.writer LIKE CONCAT('%', ?, '%') OR
           titles.genre LIKE CONCAT('%', ?, '%'))
           OR YEAR(titles.release_date) LIKE ?
    ORDER BY titles.name ASC
    LIMIT 10
");

$stmt->bind_param('sssss', $query, $query, $query, $query, $search_year);
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
