<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="background-container">
        <img id="background-image" src="https://furansujapon.com/wp-content/uploads/2022/08/one-punch-man-s3-1052x592.jpg" alt="Background Image">
        <div id="background-video" style="display:none;">
            <div class="video-overlay"></div>
            <iframe id="youtube-iframe" width="100%" height="100%" src="https://www.youtube.com/embed/h71d0QyZqRE?autoplay=1&mute=1&loop=1&controls=0&rel=0&showinfo=0&cc_load_policy=0&vq=hd1080" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
    <?php include("../includes/header.php")?>
    <main>
        <section class="highlight">
            <div class="highlight-content">
                <h1>One Punch Man</h1>
                <p>The seemingly unimpressive Saitama has a rather unique hobby: being a hero. In order to pursue his childhood dream, Saitama relentlessly trained for three years, losing all of his hair in the process. Now, Saitama is so powerful, he can defeat any enemy with just one punch. However, having no one capable of matching his strength has led Saitama to an unexpected problem—he is no longer able to enjoy the thrill of battling and has become quite bored.</p>
                <button>Learn More</button>
                <form action="add_to_watchlist.php" method="post" style="display: inline;">
                    <input type="hidden" name="title_id" value="1">
                    <button type="submit">To Watch</button>
                </form>
            </div>
        </section>

        <section class="newest">
            <h2>Terbaru</h2>
            <div class="cards">
                <?php
                require_once '../includes/config.php';
                $conn = db_connect();

                $result = $conn->query("SELECT * FROM titles ORDER BY release_date DESC LIMIT 5");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="details.php?title_id=' . $row["title_id"] . '" class="card">';
                        echo '<img src="' . $row["poster_path"] . '" alt="' . $row["name"] . '">';
                        echo '<div class="card-content">';
                        echo '<h3>' . $row["name"] . '</h3>';
                         // Mengambil tahun dari tanggal rilis
                        $release_year = date('Y', strtotime($row["release_date"]));
                        echo '<p>' . $release_year . ', ' . $row["genre"] . '</p>';
                        echo '</div>';
                        echo '</a>';
                    }
                }
                $conn->close();
                ?>
            </div>
        </section>

        <section class="featured-collections">
        <h2>Rating Tertinggi</h2>
        <div class="cards">
                <?php
                require_once '../includes/config.php';
                $conn = db_connect();

                $result = $conn->query("SELECT * FROM titles ORDER BY rating DESC LIMIT 5");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="details.php?title_id=' . $row["title_id"] . '" class="card">';
                        echo '<img src="' . $row["poster_path"] . '" alt="' . $row["name"] . '">';
                        echo '<div class="card-content">';
                        echo '<h3>' . $row["name"] . '</h3>';
                         // Mengambil tahun dari tanggal rilis
                        $release_year = date('Y', strtotime($row["release_date"]));
                        echo '<p>' . $release_year . ', ' . $row["genre"] . '</p>';
                        echo '</div>';
                        echo '</a>';
                    }
                }
                $conn->close();
                ?>
            </div>
        </section>

        <a href="catalog.php"><button class="show-more">Show More</button></a>
    </main>
    <?php include("../includes/footer.php")?>
    <script src="../assets/js/script.js"></script>
</body>
</html>