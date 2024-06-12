<?php
// Mulai sesi
session_start();

// Pengaturan untuk pelaporan kesalahan (aktifkan hanya selama pengembangan)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'aniflicks');

// Koneksi ke database
function db_connect() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

// URL dasar situs web Anda
define('BASE_URL', 'http://localhost/aniflicks');

// Path dasar untuk penyimpanan file
define('BASE_PATH', __DIR__);

// Fungsi untuk memuat file lain
function load_file($file) {
    include BASE_PATH . '/' . $file;
}

// Fungsi untuk memeriksa login pengguna
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/templates/login.php');
        exit();
    }
}

// Fungsi untuk logout
function logout() {
    session_destroy();
    header('Location: ' . BASE_URL);
    exit();
}
?>
