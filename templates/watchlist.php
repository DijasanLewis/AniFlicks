<?php
require_once '../includes/movie_function.php';

// Pastikan pengguna telah login
check_login();

// Mendapatkan status dan sort filter dari URL
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name';

// Mengambil data watchlist sesuai filter
$watchlist = get_watchlist($_SESSION['user_id'], $status_filter, $sort_by);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/watchlist.css">
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <div class="user-profile">
            <img src="<?= htmlspecialchars($_SESSION['profile_image']) ?>" alt="Profile Image" width="50" height="50">
            <h3><?= htmlspecialchars($_SESSION['username']) ?></h3>
        </div>
        <div class="status-links">
            <a href="?status=Sedang Ditonton"><button class="button2">Sedang Ditonton</button></a>
            <a href="?status=Akan Ditonton"><button class="button2">Akan Ditonton</button></a>
            <a href="?status=Selesai Ditonton"><button class="button2">Selesai Ditonton</button></a>
            <a href="?status=Ditahan"><button class="button2">Ditahan</button></a>
            <form action="" method="GET" class="sort-by">
                <h4>Urutkan Berdasarkan: </h4>
                <input type="hidden" name="status" value="<?= htmlspecialchars($status_filter) ?>">
                <select name="sort_by" onchange="this.form.submit()">
                    <option value="name" <?= $sort_by == 'name' ? 'selected' : '' ?>>Nama</option>
                    <option value="year" <?= $sort_by == 'year' ? 'selected' : '' ?>>Tahun</option>
                    <option value="rating" <?= $sort_by == 'rating' ? 'selected' : '' ?>>Rating</option>
                </select>
            </form>
        </div>
        <div class="cards">
            <?php
                if ($watchlist->num_rows > 0) {
                    while ($row = $watchlist->fetch_assoc()) {
                        echo '<a href="details.php?title_id=' . $row["title_id"] . '" class="card" data-title-id="' . $row["title_id"] . '">';
                        echo '<img src="' . htmlspecialchars($row["poster_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                        echo '<div class="card-content">';
                        echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
                        echo '<p>' . date('Y', strtotime($row["release_date"])) . ', ' . htmlspecialchars($row["genre"]) . '</p>';
                        echo '</div>';
                        echo '<div class="card-hover-overlay">';
                        echo '<button class="hover-button edit-button button1">Ganti Status</button>';
                        echo '<br>';
                        echo '<button class="hover-button remove-button button3 ">Hapus dari Daftar</button>';
                        echo '</div>';
                        echo '</a>';
                    }
                } else {
                    echo '<p>Belum ada film atau anime yang disimpan di daftar ini.</p>';
                }
            ?>
        </div>

        <div id="edit-popup" class="popup">
            <div class="popup-content">
                <button class="popup-button button1" data-status="Sedang Ditonton">Sedang Ditonton</button>
                <button class="popup-button button1" data-status="Akan Ditonton">Akan Ditonton</button>
                <button class="popup-button button1" data-status="Selesai Ditonton">Selesai Ditonton</button>
                <button class="popup-button button1" data-status="Ditahan">Ditahan</button>
                <button id="close-popup" class="popup-button button3">Batal</button>
            </div>
        </div>

    </main>
    <footer>
        <?php include("../includes/footer.php") ?>
    </footer>
    <script src="../assets/js/watchlist.js"></script>
</body>
</html>
