<?php
require_once '../includes/config.php';

// Fungsi untuk mendapatkan data dari database
function get_titles($genre_filter, $order_by) {
    $conn = db_connect();
    $sql = "SELECT * FROM titles WHERE genre LIKE '%$genre_filter%' ORDER BY $order_by";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

$genre_filter = isset($_GET['genre']) ? $_GET['genre'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'name ASC';

// Mengambil data berdasarkan filter dan urutan
$titles = get_titles($genre_filter, $order_by);

// Menentukan apakah user adalah admin
$is_admin = $_SESSION['is_admin'] ?? false;
$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/catalog.css">

</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <div class="filter-controls">
            <form action="catalog.php" method="GET">
                Genre: 
                <label>
                    <input type="checkbox" name="genre" value="Action" /> Action
                </label>
                <label>
                    <input type="checkbox" name="genre" value="Adventure" /> Adventure
                </label>
                <label>
                    <input type="checkbox" name="genre" value="Drama" /> Drama
                </label>
                <!-- Tambahkan checklist genre lainnya -->
                Urutan:
                <select name="order_by">
                    <option value="name ASC">Nama Menaik</option>
                    <option value="name DESC">Nama Menurun</option>
                    <option value="release_date ASC">Tahun Menaik</option>
                    <option value="release_date DESC">Tahun Menurun</option>
                    <option value="rating ASC">Rating Menaik</option>
                    <option value="rating DESC">Rating Menurun</option>
                </select>
                <button type="submit" class="button1">Filter</button>
            </form>
        </div>

        <div class="card-container">
            <?php
            if ($titles->num_rows > 0) {
                while ($row = $titles->fetch_assoc()) {
                    echo '<a href="details.php?title_id=' . $row["title_id"] . '" class="card">';
                    echo '<img src="' . $row["poster_path"] . '" alt="' . $row["name"] . '">';
                    echo '<div class="card-content">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    $release_year = date('Y', strtotime($row["release_date"]));
                    echo '<p>' . $release_year . ', ' . $row["genre"] . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo '<p>No titles found.</p>';
            }
            ?>
        </div>

        <?php if ($is_logged_in): ?>
            <div class="admin-controls">
                <a href="add_title.php"><button class="button1 mid-button">Tambah Film</button></a>
                <?php if ($is_admin): ?>
                    <button id="view-suggestions-button" class="button3 mid-button">Lihat Saran Film</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
    <?php include("../includes/footer.php") ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var viewSuggestionsButton = document.getElementById('view-suggestions-button');

            if (viewSuggestionsButton) {
                viewSuggestionsButton.addEventListener('click', function() {
                    window.location.href = '../admin/view_title_suggestions.php';
                });
            }
        });

        // JavaScript untuk menampilkan alert jika ada pesan error dari PHP
        window.onload = function() {
            <?php
            if (isset($_SESSION['messages'])) {
                echo "alert('{$_SESSION['messages']}');";
                unset($_SESSION['messages']); // Hapus pesan error setelah ditampilkan
            }
            ?>
        }
    </script>
</body>
</html>
