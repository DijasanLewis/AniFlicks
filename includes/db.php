<?php
    // Konfigurasi Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aniflicks";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek Koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    // Fungsi untuk menghindari input data dari SQL injection
    function escape_input($data, $conn) {
        return htmlspecialchars(mysqli_real_escape_string($conn, $data));
    }

    // Optionally, you can enable error reporting for debugging during development
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
?>
