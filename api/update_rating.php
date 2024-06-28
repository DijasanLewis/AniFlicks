<?php
require_once '../includes/config.php';

// Cek apakah user telah login
check_login();

$response = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $title_id = $data['title_id'];
    $rating = $data['rating'];
    $user_id = $_SESSION['user_id']; 

    // Koneksi ke database
    $conn = db_connect();

    // Periksa apakah judul sudah ada dalam watchlist
    $check = $conn->prepare("SELECT * FROM watchlist WHERE title_id = ? AND user_id = ?");
    $check->bind_param("ii", $title_id, $user_id);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows > 0) {
        // Perbarui rating jika sudah ada
        $stmt = $conn->prepare("UPDATE watchlist SET rating = ? WHERE title_id = ? AND user_id = ?");
        $stmt->bind_param("iii", $rating, $title_id, $user_id);
        $stmt->execute();
        $stmt->close();
        $response['message'] = "Rating updated!";
        $response['success'] = true;
    } else {
        $response['message'] = "Title not found in watchlist!";
        $response['success'] = false;
    }

    $conn->close();
} else {
    $response['message'] = "Invalid request.";
    $response['success'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);
