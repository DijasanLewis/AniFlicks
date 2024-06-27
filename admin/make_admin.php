<?php
require_once('../includes/config.php');
if (!$_SESSION['is_admin']) {
    header('Location: profile.php');
    exit();
}

$conn = db_connect();

$user_id = $_POST['user_id'];
$sql = "UPDATE users SET is_admin = 1 WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

header('Location: user_list.php');
exit();
?>
