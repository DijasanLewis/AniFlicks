<?php
require_once 'config.php';
?>

<header>
    <a href="../index.php"><div class="logo">AniFlicks</div></a>
    <nav>
        <ul>
            <li><a href="../templates/home.php">Home</a></li>
            <li><a href="../templates/catalog.php">Katalog</a></li>
            <li><a href="../templates/watchlist.php">Daftar Tontonan</a></li>
        </ul>
    </nav>
    <div class="search-login">
        <div class="search">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
                <g>
                <path
                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                ></path>
                </g>
            </svg>

            <input
                id="query"
                class="input"
                type="search"
                placeholder="Cari..."
                name="searchbar"
            />
            <div id="search-results" class="search-results"></div>
        </div>
        

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="profile">
                <a href="../templates/profile.php" class="profile-link">
                    <img src="<?php echo $_SESSION['profile_image']; ?>" alt="Profile Picture" class="profile-pic">
                    <div class="username"><?php echo $_SESSION['username']; ?></div>
                </a>
            </div>
            <div class="logout-button">
                <a href="../user/logout.php">
                    <button class="logout">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="logout-text">Logout</div>
                    </button>
                </a>
            </div>
        <?php else: ?>
            <a href="../templates/login.php"><button class="login">Masuk</button></a>
            <a href="../templates/register.php"><button class="get-started">    
                Daftar
                <div class="arrow-wrapper">
                    <div class="arrow"></div>
                </div>
            </button>
            </a>
        <?php endif; ?>
    </div>
</header>
<script src="../assets/js/ajax_search.js"></script>