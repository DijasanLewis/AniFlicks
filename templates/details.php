<?php
include('../includes/movie_function.php'); // Load fungsi-fungsi film

$title_id = $_GET['title_id'] ?? 1;
$title = get_movie_details($title_id);
$characters = get_movie_characters($title_id);
$reviews = get_movie_reviews($title_id);
$suggestions = get_character_suggestions_by_title_id($title_id); // Load saran karakter
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
        <?php if ($is_logged_in && $is_admin): ?>
            <button id="edit-characters-button">Edit Karakter</button>
        <?php elseif ($is_logged_in): ?>
            <button id="suggest-characters-button">Sarankan Perubahan</button>
        <?php endif; ?>
        <div class="cards" id="characters-static">
            <?php while($char = $characters->fetch_assoc()): ?>
                <div class="card">
                    <img src="<?= $char['image_path'] ?>" alt="<?= htmlspecialchars($char['name']) ?>">
                    <div class="card-content">
                        <h3><?= htmlspecialchars($char['name']) ?></h3>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <form id="characters-edit-form" action="<?= $is_admin ? '../admin/update_characters.php' : '../api/suggest_character_update.php' ?>" method="POST" enctype="multipart/form-data" style="display: none;">
            <div class="cards" id="characters-edit-cards">
                <?php $characters->data_seek(0); while($char = $characters->fetch_assoc()): ?>
                    <div class="card" data-id="<?= $char['character_id'] ?>">
                        <input type="hidden" name="character_id[]" value="<?= $char['character_id'] ?>">
                        <input type="hidden" name="title_id" value="<?= $title_id ?>">
                        <input type="hidden" name="current_image_path[]" value="<?= $char['image_path'] ?>">
                        <img src="<?= $char['image_path'] ?>" alt="<?= htmlspecialchars($char['name']) ?>" id="character_image_<?= $char['character_id'] ?>" class="character-image">
                        <input type="file" name="character_image[]" class="character-image-input" data-id="<?= $char['character_id'] ?>" style="display: none;">
                        <div class="card-content">
                            <input type="text" name="character_name[]" value="<?= htmlspecialchars($char['name']) ?>">
                            <button type="button" class="change-image-button" data-id="<?= $char['character_id'] ?>" style="display: none;">Ganti Gambar</button>
                            <button type="button" class="delete-character-button" data-id="<?= $char['character_id'] ?>" style="display: none;">Hapus Karakter</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <button type="button" id="add-character-button">Tambah Karakter</button>
            <button type="submit" id="save-characters-button">Simpan Perubahan</button>
        </form>

        <?php if ($is_admin && count($suggestions) > 0): ?>
            <h2>Saran Karakter</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Tambah Karakter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suggestions as $suggestion): ?>
                        <tr>
                            <td><?= htmlspecialchars($suggestion['name']) ?></td>
                            <td><img src="<?= htmlspecialchars($suggestion['image_path']) ?>" alt="Gambar Karakter" style="width: 100px;"></td>
                            <td><button class="add-character-button" data-id="<?= $suggestion['id'] ?>">Tambah Karakter</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
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
                <button id="view-suggestions-button">Lihat Daftar Saran</button>
                <form id="edit-details-form" action="../admin/update_movie.php" method="POST" enctype="multipart/form-data" style="display: none;">
            <?php else: ?>
                <button id="suggest-details-button">Suggest Edit</button>
                <form id="suggest-details-form" action="../api/suggest_movie_update.php" method="POST" enctype="multipart/form-data" style="display: none;">
            <?php endif; ?>
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
                                <dd>
                                    <input type="file" name="poster_path" id="poster_path">
                                    <img id="poster_preview" src="#" alt="Poster Preview" style="display: none; width: 100px;">
                                </dd>

                                <dt>Background</dt>
                                <dd>
                                    <input type="file" name="background_path" id="background_path">
                                    <img id="background_preview" src="#" alt="Background Preview" style="display: none; width: 100px;">
                                </dd>

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
                detailsForm.style.display = 'grid';
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
                    // PESAN NGETES
                    window.onload = function() {
                        alert('TES');
                    }
                    // PESAN NGETES
                    suggestForm.style.display = 'none';
                    confirmationMessage.style.display = 'block';
                    setTimeout(() => {
                        confirmationMessage.style.display = 'none';
                        detailsStatic.style.display = 'grid';
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

        // Preview Poster Image
        var posterInput = document.getElementById('poster_path');
        var posterPreview = document.getElementById('poster_preview');
        posterInput.addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                posterPreview.src = e.target.result;
                posterPreview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Preview Background Image
        var backgroundInput = document.getElementById('background_path');
        var backgroundPreview = document.getElementById('background_preview');
        backgroundInput.addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                backgroundPreview.src = e.target.result;
                backgroundPreview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Untuk melihat daftar saran dari user biasa
        var viewSuggestionsButton = document.getElementById('view-suggestions-button');
            if (viewSuggestionsButton) {
                viewSuggestionsButton.addEventListener('click', function() {
                    window.location.href = '../admin/view_suggestions.php?title_id=<?= $title_id ?>';
                });
            }

        var editButton = document.getElementById('edit-characters-button');
        var suggestButton = document.getElementById('suggest-characters-button');
        var charactersStatic = document.getElementById('characters-static');
        var charactersEditForm = document.getElementById('characters-edit-form');
        var addCharacterButton = document.getElementById('add-character-button');
        var charactersEditCards = document.getElementById('characters-edit-cards');
        var saveCharactersButton = document.getElementById('save-characters-button');

        if (editButton) {
            editButton.addEventListener('click', function() {
                charactersStatic.style.display = 'none';
                charactersEditForm.style.display = 'grid';
                document.querySelectorAll('.change-image-button').forEach(button => button.style.display = 'block');
                document.querySelectorAll('.delete-character-button').forEach(button => button.style.display = 'block');
            });
        }

        if (suggestButton) {
            suggestButton.addEventListener('click', function() {
                charactersStatic.style.display = 'none';
                charactersEditForm.style.display = 'grid';
                document.querySelectorAll('.change-image-button').forEach(button => button.style.display = 'block');
                document.querySelectorAll('.delete-character-button').forEach(button => button.style.display = 'block');
                saveCharactersButton.textContent = 'Sarankan Perubahan';
                charactersEditForm.action = '../api/suggest_character_update.php';
            });
        }

        addCharacterButton.addEventListener('click', function() {
            var newCard = document.createElement('div');
            newCard.classList.add('card');
            newCard.innerHTML = `
                <input type="hidden" name="character_id[]" value="new">
                <input type="hidden" name="title_id" value="<?= $title_id ?>">
                <input type="hidden" name="current_image_path[]" value="">
                <img src="#" alt="New Character" class="character-image">
                <input type="file" name="character_image[]" class="character-image-input" data-id="new" style="display: none;">
                <div class="card-content">
                    <input type="text" name="character_name[]" placeholder="Nama Karakter">
                    <button type="button" class="change-image-button" data-id="new" style="display: block;">Ganti Gambar</button>
                    <button type="button" class="delete-character-button" data-id="new" style="display: block;">Hapus Karakter</button>
                </div>
            `;
            charactersEditCards.appendChild(newCard);

            // Attach event listener for change image button
            newCard.querySelector('.change-image-button').addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                newCard.querySelector('.character-image-input').click();
            });

            // Attach event listener for image input
            newCard.querySelector('.character-image-input').addEventListener('change', function() {
                var reader = new FileReader();
                var id = this.getAttribute('data-id');
                reader.onload = function(e) {
                    newCard.querySelector('.character-image').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Attach event listener for delete button
            newCard.querySelector('.delete-character-button').addEventListener('click', function() {
                newCard.remove();
            });
        });

        document.querySelectorAll('.change-image-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                document.querySelector('.character-image-input[data-id="' + id + '"]').click();
            });
        });

        document.querySelectorAll('.character-image-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var reader = new FileReader();
                var id = this.getAttribute('data-id');
                reader.onload = function(e) {
                    document.getElementById('character_image_' + id).src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

        // Handle add character suggestion
        document.querySelectorAll('.add-character-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var suggestionId = this.getAttribute('data-id');
                fetch('../admin/accept_character_suggestion.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + suggestionId
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menambahkan karakter: ' + data.message);
                    }
                }).catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.delete-character-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var card = this.closest('.card');
                card.remove();
            });
        });
    });
</script>
</body>
</html>
