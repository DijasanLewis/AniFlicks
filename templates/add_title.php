<?php
require_once '../includes/config.php';
check_login();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <h2>Tambah Film</h2>
        <form id="add-title-form" action="../api/add_title.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 0 ?>">
            <div class="details-grid">
                <div class="details-left">
                    <dl>
                        <dt>Judul</dt>
                        <dd><input type="text" name="name" class="input input-description" required></dd>

                        <dt>Rating</dt>
                        <dd><input type="number" step="0.1" name="rating" class="input input-description" required></dd>

                        <dt>Tanggal Rilis</dt>
                        <dd><input type="date" name="release_date" class="input input-description" required></dd>

                        <dt>Genre</dt>
                        <dd><input type="text" name="genre" class="input input-description" required></dd>

                        <dt>Penulis</dt>
                        <dd><input type="text" name="writer" class="input input-description" required></dd>

                        <dt>Studio</dt>
                        <dd><input type="text" name="studio" class="input input-description" required></dd>

                        <dt>Poster</dt>
                        <dd>
                            <input type="file" name="poster_path" id="poster_path" required>
                            <img id="poster_preview" src="#" alt="Poster Preview" style="display: none; width: 100px;">
                        </dd>

                        <dt>Background</dt>
                        <dd>
                            <input type="file" name="background_path" id="background_path" required>
                            <img id="background_preview" src="#" alt="Background Preview" style="display: none; width: 100px;">
                        </dd>

                        <dt>Trailer Link</dt>
                        <dd><input type="text" name="trailer_link" class="input input-description" required></dd>

                        <dt>Sinopsis</dt>
                        <dd><textarea name="sinopsis" class="input input-description input-text-small" required></textarea></dd>

                        <dt>Deskripsi</dt>
                        <dd><textarea name="description" class="input input-description input-text-big" required></textarea></dd>
                    </dl>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="button1">Simpan</button>
                <button type="button" id="cancel-add-button" class="button3">Batal</button>
            </div>
        </form>
    </main>
    <?php include("../includes/footer.php") ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var posterInput = document.getElementById('poster_path');
        var posterPreview = document.getElementById('poster_preview');
        var backgroundInput = document.getElementById('background_path');
        var backgroundPreview = document.getElementById('background_preview');
        var cancelButton = document.getElementById('cancel-add-button');

        posterInput.addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                posterPreview.src = e.target.result;
                posterPreview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        });

        backgroundInput.addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                backgroundPreview.src = e.target.result;
                backgroundPreview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        });

        cancelButton.addEventListener('click', function() {
            window.location.href = 'catalog.php';
        });
    });
    </script>
</body>
</html>
