<?php
require_once '../includes/config.php';

// Mengambil 10 film dengan rating tertinggi
$conn = db_connect();
$result = $conn->query("SELECT * FROM titles ORDER BY rating DESC LIMIT 10");

$top_rated_movies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $top_rated_movies[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/slider.css">
</head>
<body>
    <div class="background-container">
        <img id="background-image" src="<?= $top_rated_movies[0]['background_path'] ?>" alt="Background Image">
        <div class="video-overlay"></div>
        <div id="background-video" style="display:none;">
            <iframe id="youtube-iframe" width="100%" height="100%" src="<?= $top_rated_movies[0]['trailer_link'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
    <?php include("../includes/header.php") ?>
    <main>
        <section class="highlight">
            <div class="highlight-content">
                <h1><?= htmlspecialchars($top_rated_movies[0]['name']) ?></h1>
                <p><?= htmlspecialchars($top_rated_movies[0]['sinopsis']) ?></p>
                <a href="details.php?title_id=<?= $top_rated_movies[0]['title_id'] ?>" class="button1" id="lihat-film-button">Lihat Film</a>
            </div>
        </section>

        <section class="slider">
            <h2>Rating Tertinggi</h2>
            <div class="slider-container">
                <button class="slider-prev">&#10094;</button>
                <div class="slider-wrapper">
                    <div class="slider-content">
                        <?php
                        foreach ($top_rated_movies as $movie) {
                            echo '<a href="details.php?title_id=' . $movie["title_id"] . '" class="card">';
                            echo '<img src="' . $movie["poster_path"] . '" alt="' . $movie["name"] . '">';
                            echo '<div class="card-content">';
                            echo '<h3>' . $movie["name"] . '</h3>';
                            $release_year = date('Y', strtotime($movie["release_date"]));
                            echo '<p>' . $release_year . ', ' . $movie["genre"] . '</p>';
                            echo '</div>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
                <button class="slider-next">&#10095;</button>
            </div>
        </section>

        <section class="slider">
            <h2>Terbaru</h2>
            <div class="slider-container">
                <button class="slider-prev">&#10094;</button>
                <div class="slider-wrapper">
                    <div class="slider-content">
                        <?php
                        $result = $conn->query("SELECT * FROM titles ORDER BY release_date DESC LIMIT 5");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<a href="details.php?title_id=' . $row["title_id"] . '" class="card">';
                                echo '<img src="' . $row["poster_path"] . '" alt="' . $row["name"] . '">';
                                echo '<div class="card-content">';
                                echo '<h3>' . $row["name"] . '</h3>';
                                $release_year = date('Y', strtotime($row["release_date"]));
                                echo '<p>' . $release_year . ', ' . $row["genre"] . '</p>';
                                echo '</div>';
                                echo '</a>';
                            }
                        }
                        ?>
            </div>
                </div>
                <button class="slider-next">&#10095;</button>
            </div>
        </section>

        <a href="catalog.php"><button class="button1 mid-button">Lihat Lebih Banyak</button></a>
    </main>
    <?php include("../includes/footer.php") ?>
    <script>
        var topRatedMovies = <?= json_encode($top_rated_movies); ?>;
    </script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/slider.js"></script>
</body>
</html>
