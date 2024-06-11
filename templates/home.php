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
                <button>To Watch</button>
            </div>
        </section>

        <section class="special">
            <h2>Spesial Buat Kamu</h2>
            <div class="cards">
                <!-- Add more cards as needed -->
                <div class="card">
                    <img src="https://cdn.myanimelist.net/images/anime/1885/127108l.jpg" alt="Sample Title">
                    <div class="card-content">
                        <h3>One Punch Man</h3>
                        <p>2015, Action </p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://cdn.myanimelist.net/images/anime/1885/127108l.jpg" alt="Sample Title">
                    <div class="card-content">
                        <h3>One Punch Man</h3>
                        <p>2015, Action </p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://cdn.myanimelist.net/images/anime/1885/127108l.jpg" alt="Sample Title">
                    <div class="card-content">
                        <h3>One Punch Man</h3>
                        <p>2015, Action </p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://cdn.myanimelist.net/images/anime/1885/127108l.jpg" alt="Sample Title">
                    <div class="card-content">
                        <h3>One Punch Man</h3>
                        <p>2015, Action </p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://cdn.myanimelist.net/images/anime/1885/127108l.jpg" alt="Sample Title">
                    <div class="card-content">
                        <h3>One Punch Man</h3>
                        <p>2015, Action </p>
                    </div>
                </div>
                
            </div>
        </section>

        <section class="featured-collections">
            <h2>Paling Populer</h2>
            <div class="cards">
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="images/sample.jpg" alt="Sample Collection">
                    <div class="card-content">
                        <h3>The Best Mystical Anime</h3>
                    </div>
                </div>

                <!-- Add more cards as needed -->
            </div>
        </section>

        <section class="trending">
            <h2>Sedang Trending</h2>
            <div class="cards">
                <div class="card">
                    <img src="images/sample.jpg" alt="Trending Title">
                    <div class="card-content">
                        <h3>Trending Title</h3>
                        <p>2024, Action</p>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </section>

        <button class="show-more">Show More</button>
    </main>
    <?php include("../includes/footer.php")?>
    <script src="../assets/js/script.js"></script>
</body>
</html>