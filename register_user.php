<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($password == $confirm_password) {
        // Periksa apakah username sudah ada
        $check_username = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $check_username->bind_param("s", $username);
        $check_username->execute();
        $check_username->store_result();

        if ($check_username->num_rows > 0) {
            echo "Username sudah terdaftar.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $username, $hashed_password); // Email diisi dengan username untuk sementara, bisa diganti
            if ($stmt->execute()) {
                echo "Pendaftaran berhasil. Silakan <a href='login.php'>login</a>.";
            } else {
                echo "Terjadi kesalahan: " . $stmt->error;
            }
            $stmt->close();
        }

        $check_username->close();
    } else {
        echo "Password dan Konfirmasi Password tidak cocok.";
    }

    $conn->close();
}
?>