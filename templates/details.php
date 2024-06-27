<?php
include('../includes/movie_function.php'); // Load fungsi-fungsi film

$title_id = $_GET['title_id'] ?? 1;
$title = get_movie_details($title_id);
$reviews = get_movie_reviews($title_id);
$watchlist_entry = NULL;
$is_admin = FALSE;
$is_logged_in = FALSE;

// Jika sudah login
if (isset($_SESSION['user_id'])){
    $is_admin = $_SESSION['is_admin'];
    $watchlist_entry = is_movie_in_watchlist($_SESSION['user_id'], $title_id);
    $is_logged_in = TRUE;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title['name']) ?> - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/details_characters.css">
</head>
<body>
    <div class="background-container">
        <div class="video-overlay"></div>
        <img id="background-image" src="<?= $title['background_path'] ?>" alt="<?= htmlspecialchars($title['name']) ?>">
        <?php if (!empty($title['trailer_link'])): ?>
            <div id="background-video">
                <?php
                    $video_id = explode("v=", $title['trailer_link']);
                    $video_id = explode("&", $video_id[1])[0];  // Memastikan hanya ID video yang diambil jika ada parameter lain
                    $loopable_link = "https://www.youtube.com/embed/$video_id?controls=0&rel=0&showinfo=0&autoplay=1&mute=1&loop=1&cc_load_policy=0&vq=hd1080&playlist=$video_id";
                ?>
                <iframe id="youtube-iframe" width="100%" height="100%" src="<?= $loopable_link ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    </div>
    <?php include("../includes/header.php") ?>
    <main>
        <section class="highlight">
            <div class="highlight-content">
                <h1><?= htmlspecialchars($title['name']) ?></h1>
                <p><?= htmlspecialchars($title['sinopsis']) ?></p>
                <div>
                    <?php if (!$watchlist_entry): ?>
                        <button class="to-watch-button button1" data-title-id="<?= $title_id ?>">To Watch</button>
                    <?php else: ?>
                        <h3>Rating!</h3>
                        <div class="rating">
                            <?php for ($i = 10; $i >= 1; $i--): ?>
                                <input value="<?= $i ?>" name="rating" id="star<?= $i ?>" type="radio" <?= $watchlist_entry['rating'] == $i ? 'checked' : '' ?>>
                                <label for="star<?= $i ?>"></label>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <nav class="tabs">
            <button class="tab-button button2" data-tab="characters">Characters</button>
            <button class="tab-button button2" data-tab="details">Details</button>
            <button class="tab-button button2" data-tab="reviews">Reviews</button>
        </nav>

        <section id="characters" class="tab-content">
            <?php include('../templates/details_characters.php'); ?>
        </section>

        <section id="details" class="tab-content" style="display: none;">
            <?php include('../templates/details_descriptions.php'); ?>
        </section>

        <section id="reviews" class="tab-content" style="display: none;">
            <?php include('../templates/details_reviews.php'); ?>
        </section>
        <?php if ($is_admin): ?>
            <button class="delete-movie-button button3" data-title-id="<?= $title_id ?>">Hapus Film</button>
        <?php endif; ?>
    </main>
    <?php include("../includes/footer.php") ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan status login dari PHP
        var isLoggedIn = <?= json_encode($is_logged_in); ?>;    
        var baseUrl = typeof baseUrl !== 'undefined' ? baseUrl : '';

        // Fungsi untuk menangani fungsionalitas tab
        function handleTabs() {
            var tabButtons = document.querySelectorAll('.tab-button');
            var tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var tab = this.getAttribute('data-tab');
                    tabButtons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });
                    tabContents.forEach(function(content) {
                        content.style.display = content.id === tab ? 'block' : 'none';
                    });
                    this.classList.add('active');
                });
            });
        }

        handleTabs();
        
        // Tambahkan event listener untuk tombol To Watch
        var watchButton = document.querySelector('.to-watch-button');
        if (watchButton) {
            watchButton.addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan form dari submit biasa
                if (!isLoggedIn) {
                    window.location.href = baseUrl + '/templates/login.php'; // Redirect to login page if not logged in
                } else {
                    var titleId = this.getAttribute('data-title-id');
                    addToWatchlist(titleId);
                }
            });
        }

        // Fungsi untuk menambahkan film ke watchlist
        function addToWatchlist(titleId) {
            fetch('../api/update_watchlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ title_id: titleId })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('Film berhasil ditambahkan ke watchlist');
                    location.reload();
                } else {
                    alert('Gagal menambahkan film ke watchlist');
                }
            }).catch(error => console.error('Error:', error));
        }

        // Fungsi untuk memperbarui rating film
        function updateRating(titleId, rating) {
            fetch('../api/update_rating.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ title_id: titleId, rating: rating })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('Rating berhasil diperbarui');
                } else {
                    alert('Gagal memperbarui rating');
                }
            }).catch(error => console.error('Error:', error));
        }

        // Event listener untuk rating
        var ratingInputs = document.querySelectorAll('.rating input');
        ratingInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                var titleId = input.getAttribute('data-title-id');
                var rating = this.value;
                updateRating(titleId, rating);
            });
        });

        // Fungsi untuk memuat lebih banyak ulasan
        function loadMoreReviews() {
            var titleId = <?= $title_id ?>;
            fetch(`../api/load_more_reviews.php?title_id=${titleId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var comments = document.getElementById('comments');
                        data.reviews.forEach(review => {
                            var reviewElement = document.createElement('div');
                            reviewElement.classList.add('review');
                            reviewElement.innerHTML = `<p><strong>${review.username}:</strong> ${review.comment}</p><p><small>Posted on: ${review.date_posted}</small></p>`;
                            comments.appendChild(reviewElement);
                        });
                    } else {
                        alert('Gagal memuat ulasan tambahan');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Event listener untuk tombol "Load More Reviews"
        var loadMoreButton = document.getElementById('load-more-reviews-button');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function(event) {
                event.preventDefault();
                loadMoreReviews();
            });
        }

        // Event listener untuk tombol "Hapus Film"
        var deleteButton = document.querySelector('.delete-movie-button');
        if (deleteButton) {
            deleteButton.addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus film ini?')) {
                    var titleId = this.getAttribute('data-title-id');
                    deleteMovie(titleId);
                    window.location.href = '../templates/catalog.php';
                }
            });
        }

        // Fungsi untuk menghapus film
        function deleteMovie(titleId) {
            fetch('../admin/delete_title.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ title_id: titleId })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('Film berhasil dihapus');
                    window.location.href = '../templates/catalog.php'; // Redirect to catalog page
                } else {
                    alert('Gagal menghapus film');
                }
            }).catch(error => console.error('Error:', error));
        }
    });
    </script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
