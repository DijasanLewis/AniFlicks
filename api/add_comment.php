<?php
require_once('../includes/movie_function.php');

$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $title_id = $data['title_id'] ?? 0;
    $comment = $data['comment'] ?? '';

    if ($user_id && $title_id && !empty($comment)) {
        $conn = db_connect();
        $stmt = $conn->prepare("INSERT INTO reviews (title_id, user_id, comment, date_posted) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $title_id, $user_id, $comment);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Komentar berhasil ditambahkan!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal Menambahkan Komentar.']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Pengguna Belum Login atau Input Tidak Valid.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
