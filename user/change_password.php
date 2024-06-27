<?php
require_once('../includes/config.php');

$conn = db_connect();
$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Fetch the current password from the database
$sql = "SELECT password FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$hashed_password = $row['password'];

if (password_verify($current_password, $hashed_password)) {
    if ($new_password === $confirm_password) {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_hashed_password, $user_id);
        $stmt->execute();
        $_SESSION['password_change_message'] = "Password berhasil diubah.";
    } else {
        $_SESSION['password_change_message'] = "Password baru tidak cocok.";
    }
} else {
    $_SESSION['password_change_message'] = "Password saat ini salah.";
}

header('Location: ../templates/profile.php');
exit();
?>
