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
    <style>
        main {
            min-height: 80vh;
        }
        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-profile img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .card-hover-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover .card-hover-overlay {
            opacity: 1;
        }

        .hover-button {
            background-color: #fff;
            color: #333;
            border: none;
            padding: 10px 15px;
            margin: 5px 0;
            cursor: pointer;
            border-radius: 5px;
        }

        .hover-button:hover {
            background-color: #ddd;
        }

        /* Style untuk formulir sort-by */
        .sort-by {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .sort-by select {
            margin: 0 2em;
            appearance: none;
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .sort-by select:hover {
            background-color: #3c3c3c;
            border-color: #555;
        }

        .sort-by select:focus {
            border-color: #777;
        }

        /* Style untuk anak panah select box */
        .sort-by select::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: #fff;
            pointer-events: none;
            transform: translateY(-50%);
        }


        .popup {
            display: none; /* Sembunyikan pop-up secara default */
            position: fixed; /* Posisi tetap di layar */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Latar belakang semi transparan */
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: black;
            padding: 20px;
            border-radius: 20px;
            text-align: center;
        }


    </style>
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
                        echo '<button class="hover-button edit-button">Ganti Status</button>';
                        echo '<button class="hover-button remove-button">Hapus dari Daftar</button>';
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
