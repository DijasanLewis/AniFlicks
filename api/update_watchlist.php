<?php
require_once '../includes/config.php';

// Cek apakah user telah login
check_login();

$response = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title_id = $_POST['title_id'];
    $user_id = $_SESSION['user_id']; // Asumsi bahwa user_id disimpan dalam session saat login

    // Koneksi ke database
    $conn = db_connect();

    // Periksa apakah judul sudah ada dalam watchlist
    $check = $conn->prepare("SELECT * FROM watchlist WHERE title_id = ? AND user_id = ?");
    $check->bind_param("ii", $title_id, $user_id);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows == 0) {
        // Tambahkan ke database jika belum ada
        $stmt = $conn->prepare("INSERT INTO watchlist (user_id, title_id, watched) VALUES (?, ?, 'Sedang Ditonton')");
        $stmt->bind_param("ii", $user_id, $title_id);
        $stmt->execute();
        $stmt->close();
        $response['message'] = "Added to watchlist!";
        $response['status'] = 'success';
    } else {
        $response['message'] = "Already in watchlist!";
        $response['status'] = 'info';
    }

    $conn->close();
} else {
    $response['message'] = "Invalid request.";
    $response['status'] = 'error';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
