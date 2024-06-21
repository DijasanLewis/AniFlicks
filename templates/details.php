<?php
include('../includes/movie_function.php'); // Load fungsi-fungsi film

$title_id = $_GET['title_id'] ?? 1;
$title = get_movie_details($title_id);
$characters = get_movie_characters($title_id);
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
</head>
<body>
    <div class="background-container">
        <div class="video-overlay"></div>
        <img id="background-image" src="<?= $title['background_path'] ?>" alt="<?= htmlspecialchars($title['name']) ?>">
        <?php if (!empty($title['trailer_link'])): ?>
            <div id="background-video">
                <?php
                    // Mengambil ID video dari URL trailer, mengasumsikan URL mengandung 'v=ID_VIDEO'
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
                    <button class="to-watch-button" data-title-id="<?= $title_id ?>">To Watch</button>
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
            <button class="tab-button" data-tab="characters">Characters</button>
            <button class="tab-button" data-tab="details">Details</button>
            <button class="tab-button" data-tab="reviews">Reviews</button>
        </nav>

        <section id="characters" class="tab-content">
            <h2>Karakter</h2>
            <div class="cards">
                <?php while($char = $characters->fetch_assoc()): ?>
                    <div class="card">
                        <img src="<?= $char['image_path'] ?>" alt="<?= htmlspecialchars($char['name']) ?>">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($char['name']) ?></h3>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section id="details" class="tab-content" style="display: none;">
            <h2>Details</h2>
            <div class="details-grid" id="details-static">
                <div class="details-left">
                    <dl>
                        <dt>Judul</dt>
                        <dd data-field="name"><?= htmlspecialchars($title['name']) ?></dd>

                        <dt>Rating</dt>
                        <dd data-field="rating"><?= $title['rating'] ?></dd>

                        <dt>Tanggal Rilis</dt>
                        <dd data-field="release_date"><?= date('j F Y', strtotime($title['release_date'])) ?></dd>

                        <dt>Genre</dt>
                        <dd data-field="genre"><?= $title['genre'] ?></dd>

                        <dt>Penulis</dt>
                        <dd data-field="writer"><?= $title['writer'] ?></dd>

                        <dt>Studio</dt>
                        <dd data-field="studio"><?= $title['studio'] ?></dd>
                    </dl>
                </div>
                <div class="details-right">
                    <p><strong>DESKRIPSI:</strong></p>
                    <p data-field="description"><?= htmlspecialchars($title['description']) ?></p>
                </div>
            </div>
            <?php if ($is_logged_in): ?>
            <?php if ($is_admin): ?>
                <button id="edit-details-button">Edit Details</button>
                <form id="edit-details-form" action="../api/update_movie.php" method="POST" enctype="multipart/form-data" style="display: none;">
                    <input type="hidden" name="title_id" value="<?= $title_id ?>">
                    <div class="details-grid">
                        <div class="details-left">
                            <dl>
                                <dt>Judul</dt>
                                <dd><input type="text" name="name" value="<?= htmlspecialchars($title['name']) ?>" required></dd>

                                <dt>Rating</dt>
                                <dd><input type="number" step="0.1" name="rating" value="<?= $title['rating'] ?>" required></dd>

                                <dt>Tanggal Rilis</dt>
                                <dd><input type="date" name="release_date" value="<?= $title['release_date'] ?>" required></dd>

                                <dt>Genre</dt>
                                <dd><input type="text" name="genre" value="<?= htmlspecialchars($title['genre']) ?>" required></dd>

                                <dt>Penulis</dt>
                                <dd><input type="text" name="writer" value="<?= htmlspecialchars($title['writer']) ?>" required></dd>

                                <dt>Studio</dt>
                                <dd><input type="text" name="studio" value="<?= htmlspecialchars($title['studio']) ?>" required></dd>

                                <dt>Poster</dt>
                                <dd><input type="file" name="poster_path" required></dd>

                                <dt>Background</dt>
                                <dd><input type="file" name="background_path" required></dd>

                                <dt>Trailer Link</dt>
                                <dd><input type="text" name="trailer_link" value="<?= htmlspecialchars($title['trailer_link']) ?>" required></dd>

                                <dt>Sinopsis</dt>
                                <dd><textarea name="sinopsis" required><?= htmlspecialchars($title['sinopsis']) ?></textarea></dd>
                            </dl>
                        </div>
                        <div class="details-right">
                            <p><strong>DESKRIPSI:</strong></p>
                            <textarea name="description" required><?= htmlspecialchars($title['description']) ?></textarea>
                        </div>
                    </div>
                    <button type="submit">Update</button>
                </form>
                <?php else: ?>
                <button id="suggest-details-button">Suggest Edit</button>
                <form id="suggest-details-form" action="../api/suggest_movie_update.php" method="POST" enctype="multipart/form-data" style="display: none;">
                    <input type="hidden" name="title_id" value="<?= $title_id ?>">
                    <div class="details-grid">
                        <div class="details-left">
                            <dl>
                                <dt>Judul</dt>
                                <dd><input type="text" name="name" value="<?= htmlspecialchars($title['name']) ?>" required></dd>

                                <dt>Rating</dt>
                                <dd><input type="number" step="0.1" name="rating" value="<?= $title['rating'] ?>" required></dd>

                                <dt>Tanggal Rilis</dt>
                                <dd><input type="date" name="release_date" value="<?= $title['release_date'] ?>" required></dd>

                                <dt>Genre</dt>
                                <dd><input type="text" name="genre" value="<?= htmlspecialchars($title['genre']) ?>" required></dd>

                                <dt>Penulis</dt>
                                <dd><input type="text" name="writer" value="<?= htmlspecialchars($title['writer']) ?>" required></dd>

                                <dt>Studio</dt>
                                <dd><input type="text" name="studio" value="<?= htmlspecialchars($title['studio']) ?>" required></dd>

                                <dt>Poster</dt>
                                <dd><input type="file" name="poster_path" required></dd>

                                <dt>Background</dt>
                                <dd><input type="file" name="background_path" required></dd>

                                <dt>Trailer Link</dt>
                                <dd><input type="text" name="trailer_link" value="<?= htmlspecialchars($title['trailer_link']) ?>" required></dd>

                                <dt>Sinopsis</dt>
                                <dd><textarea name="sinopsis" required><?= htmlspecialchars($title['sinopsis']) ?></textarea></dd>
                            </dl>
                        </div>
                        <div class="details-right">
                            <p><strong>DESKRIPSI:</strong></p>
                            <textarea name="description" required><?= htmlspecialchars($title['description']) ?></textarea>
                        </div>
                    </div>
                    <button type="submit">Submit Suggestion</button>
                </form>
            <?php endif; ?>
            <?php endif; ?>
            <div id="confirmation-message" style="display: none;">
                <p>Terima kasih! Perubahan yang kamu ajukan akan ditinjau kembali oleh Admin!</p>
            </div>
        </section>


        <section id="reviews" class="tab-content" style="display: none;">
            <h2>ULASAN</h2>
            <form id="comment-form">
                <textarea id="comment" name="comment" placeholder="Add your comment" required></textarea>
                <button type="submit">Beri Komentar</button>
            </form>
            <div id="comments">
                <?php while($review = $reviews->fetch_assoc()): ?>
                    <div class="review">
                        <p><strong><?= htmlspecialchars($review['username']) ?>:</strong> <?= htmlspecialchars($review['comment']) ?></p>
                        <p><small>Posted on: <?= $review['date_posted'] ?></small></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>
    <?php include("../includes/footer.php") ?>
    <script src="../assets/js/script.js"></script>
    <script>
        // Mendapatkan status login dari PHP
        var isLoggedIn = <?= json_encode($is_logged_in) ?>;
        var baseUrl = <?= json_encode(BASE_URL) ?>;

        document.addEventListener('DOMContentLoaded', function() {
            var editButton = document.getElementById('edit-details-button');
            var suggestButton = document.getElementById('suggest-details-button');
            var detailsForm = document.getElementById('edit-details-form');
            var suggestForm = document.getElementById('suggest-details-form');
            var detailsStatic = document.getElementById('details-static');
            var confirmationMessage = document.getElementById('confirmation-message');

            if (editButton) {
                editButton.addEventListener('click', function() {
                    detailsStatic.style.display = 'none';
                    detailsForm.style.display = 'block';
                });
            }

            if (suggestButton) {
                suggestButton.addEventListener('click', function() {
                    detailsStatic.style.display = 'none';
                    suggestForm.style.display = 'block';
                });
            }

            if (suggestForm) {
                suggestForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(suggestForm);
                    fetch('../api/suggest_movie_update.php', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.text()).then(data => {
                        suggestForm.style.display = 'none';
                        confirmationMessage.style.display = 'block';
                        setTimeout(() => {
                            confirmationMessage.style.display = 'none';
                            detailsStatic.style.display = 'block';
                        }, 3000); // Mengembalikan tampilan detail menjadi statis setelah 3 detik
                    }).catch(error => console.error('Error:', error));
                });
            }

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

            var ratingInputs = document.querySelectorAll('.rating input');
            ratingInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    var titleId = <?= $title_id ?>;
                    var rating = this.value;
                    updateRating(titleId, rating);
                });
            });

            var tabButtons = document.querySelectorAll('.tab-button');
            var tabContents = document.querySelectorAll('.tab-content');
            tabButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var tab = this.getAttribute('data-tab');
                    tabContents.forEach(function(content) {
                        content.style.display = content.id === tab ? 'block' : 'none';
                    });
                });
            });

            var commentForm = document.getElementById('comment-form');
            commentForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var comment = document.getElementById('comment').value;
                addComment(<?= $title_id ?>, comment);
            });
        });
    </script>
</body>
</html>