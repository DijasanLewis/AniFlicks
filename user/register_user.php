<?php
require_once '../includes/config.php';
$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($password == $confirm_password) {
        // Periksa apakah email sudah ada
        $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();

        if ($check_email->num_rows > 0) {
            echo "email sudah terdaftar.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            if ($stmt->execute()) {
                $_SESSION['messages'] = "Pendaftaran Akun Berhasil. Silahkan Login!.";
                header("Location: ../templates/login.php");
                exit();
            } else {
                $_SESSION['messages'] = "Terjadi kesalahan: " . $stmt->error;
                header("Location: ../templates/register.php");
                exit();
            }
            $stmt->close();
        }

        $check_email->close();
    } else {
        $_SESSION['messages'] = "Password dan Konfirmasi Password tidak cocok.";
        header("Location: ../templates/register.php");
        exit();
    }

    $conn->close();
}
?>