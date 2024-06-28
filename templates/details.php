<?php
require_once('../includes/movie_function.php'); // Load fungsi-fungsi film

$title_id = $_GET['title_id'] ?? 1;
$title = get_movie_details($title_id);
$reviews = get_movie_reviews($title_id);
$watchlist_entry = NULL;
$is_admin = FALSE;
$is_logged_in = FALSE;

// Memeriksa apakah pengguna sudah login
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
        <img id="background-image" src="<?= $title['background_path'] ?>" alt="<?= htmlspecialchars($title['name']) ?>">
        <div class="video-overlay"></div>
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
                        <button class="to-watch-button button1" data-title-id="<?= $title_id ?>">Simpan</button>
                    <?php else: ?>
                        <h3>Rating!</h3>
                        <div class="rating">
                            <?php for ($i = 10; $i >= 1; $i--): ?>
                                <input value="<?= $i ?>" name="rating" id="star<?= $i ?>" type="radio" data-title-id="<?= $title_id ?>" <?= $watchlist_entry['rating'] == $i ? 'checked' : '' ?>>
                                <label for="star<?= $i ?>"></label>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <nav class="tabs">
            <button class="tab-button button2" data-tab="characters">Karakter</button>
            <button class="tab-button button2" data-tab="details">Detail</button>
            <button class="tab-button button2" data-tab="reviews">Ulasan</button>
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
           var isLoggedIn = <?= json_encode($is_logged_in); ?>;    
           var baseUrl = typeof baseUrl !== 'undefined' ? baseUrl : '';
           var titleId = <?= $title_id ?>;
    </script>
    <script src="../assets/js/details.js"></script>
    <script src="../assets/js/background_video.js"></script>
</body>
</html>
