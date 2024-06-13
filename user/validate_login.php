<?php
require_once '../includes/config.php';
$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['profile_image'] = $user['profile_image'];
            header("Location: ../templates/home.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Tidak ada pengguna dengan email tersebut.";
    }

    $conn->close();
}
?>
