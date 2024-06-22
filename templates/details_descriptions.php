<?php
$is_admin = $_SESSION['is_admin'] ?? false;
$is_logged_in = isset($_SESSION['user_id']);
?>

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
<script>
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
                alert('Saran berhasil dikirim');
                suggestForm.style.display = 'none';
                confirmationMessage.style.display = 'block';
                setTimeout(() => {
                    confirmationMessage.style.display = 'none';
                    detailsStatic.style.display = 'grid';
                }, 3000);
            }).catch(error => console.error('Error:', error));
        });
    }

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
});

</script>