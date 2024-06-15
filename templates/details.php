<?php
include('../includes/movie_function.php'); // Load fungsi-fungsi film

$title_id = $_GET['title_id'] ?? 1;
$title = get_movie_details($title_id);
$characters = get_movie_characters($title_id);
$reviews = get_movie_reviews($title_id);
$watchlist_entry = is_movie_in_watchlist($_SESSION['user_id'], $title_id);
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

        <section class="characters">
            <h2>Characters</h2>
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

        <section class="reviews">
            <h2>Reviews</h2>
            <?php while($review = $reviews->fetch_assoc()): ?>
                <div class="review">
                    <p><strong><?= htmlspecialchars($review['username']) ?>:</strong> <?= htmlspecialchars($review['comment']) ?></p>
                    <p>Rating: <?= $review['rating'] ?></p>
                </div>
            <?php endwhile; ?>
        </section>
    </main>
    <?php include("../includes/footer.php") ?>
    <script src="../assets/js/script.js"></script>
    <script>
        

        // Tambahkan event listener untuk tombol To Watch
        document.addEventListener('DOMContentLoaded', function() {
            var watchButton = document.querySelector('.to-watch-button');
            if (watchButton) {
                watchButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Menghentikan form dari submit biasa
                    var titleId = this.getAttribute('data-title-id');
                    addToWatchlist(titleId);
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
        });
    </script>
</body>
</html>