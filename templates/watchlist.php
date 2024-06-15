<?php
require_once '../includes/config.php';

// Pastikan pengguna telah login
check_login();

// Fungsi untuk mengambil data watchlist
function get_watchlist($user_id, $status = '') {
    $conn = db_connect();
    $query = "SELECT titles.*, watchlist.watched FROM titles JOIN watchlist ON titles.title_id = watchlist.title_id WHERE watchlist.user_id = ?";
    if (!empty($status)) {
        $query .= " AND watchlist.watched = ?";
    }
    $stmt = $conn->prepare($query);
    if (!empty($status)) {
        $stmt->bind_param("is", $user_id, $status);
    } else {
        $stmt->bind_param("i", $user_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();
    return $result;
}

// Mendapatkan status filter dari URL
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

// Mengambil data watchlist sesuai filter
$watchlist = get_watchlist($_SESSION['user_id'], $status_filter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-profile img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .status-links {
            margin-bottom: 20px;
        }

        .status-links a, .status-links button {
            margin-right: 15px;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .status-links button {
            border: none;
            cursor: pointer;
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

    </style>
</head>
<body>
    <header>
        <?php include("../includes/header.php") ?>
    </header>
    <main>
        <div class="user-profile">
            <img src="<?= htmlspecialchars($_SESSION['profile_image']) ?>" alt="Profile Image" width="50" height="50">
            <h3><?= htmlspecialchars($_SESSION['username']) ?></h3>
        </div>
        <div class="status-links">
            <a href="?status=Sedang Ditonton">Sedang Ditonton</a>
            <a href="?status=Akan Ditonton">Akan Ditonton</a>
            <a href="?status=Selesai Ditonton">Selesai Ditonton</a>
            <a href="?status=Ditahan">Ditahan</a>
            <button>Sort By</button>
            <button>Filter</button>
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
                        echo '<button class="hover-button edit-button">Edit Status</button>';
                        echo '<button class="hover-button remove-button">Remove</button>';
                        echo '</div>';
                        echo '</a>';
                    }
                } else {
                    echo '<p>No titles found.</p>';
                }
            ?>

        </div>
    </main>
    <footer>
        <?php include("../includes/footer.php") ?>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mencegah link <a> diikuti saat tombol ditekan
            document.querySelectorAll('.card').forEach(card => {
                card.addEventListener('click', event => {
                    const editButton = event.target.closest('.edit-button');
                    const removeButton = event.target.closest('.remove-button');

                    if (editButton || removeButton) {
                        event.preventDefault();  // Mencegah navigasi ke details.php
                    }

                    if (editButton) {
                        const titleId = card.getAttribute('data-title-id');
                        editStatus(titleId);
                    }

                    if (removeButton) {
                        const titleId = card.getAttribute('data-title-id');
                        removeFromWatchlist(titleId);
                    }
                });
            });
        });
        function editStatus(titleId) {
            var newStatus = prompt("Please enter the new status (Sedang Ditonton, Akan Ditonton, Selesai Ditonton, Ditahan):");
            if (!newStatus) return;  // Jika pengguna membatalkan prompt, hentikan fungsi

            fetch('../api/edit_watchlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'title_id=' + encodeURIComponent(titleId) + '&new_status=' + encodeURIComponent(newStatus)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    window.location.reload();  // Reload halaman untuk menampilkan data terbaru
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function removeFromWatchlist(titleId) {
            if (!confirm("Are you sure you want to remove this title from your watchlist?")) return;

            fetch('../api/remove_from_watchlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'title_id=' + encodeURIComponent(titleId)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    window.location.reload();  // Reload halaman untuk menghapus card yang dihapus
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
