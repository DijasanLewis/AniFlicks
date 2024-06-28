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
        <button id="edit-details-button" class="button1">Edit Detail</button>
        <button id="view-suggestions-button" class="button2">Lihat Saran</button>
        <form id="edit-details-form" action="../admin/update_movie.php" method="POST" enctype="multipart/form-data" style="display: none;">
            <input type="hidden" name="title_id" value="<?= $title_id ?>">
            <div class="details-grid">
                <div class="details-left">
                    <dl>
                        <dt>Judul</dt>
                        <dd><input type="text" name="name" class="input input-description" value="<?= htmlspecialchars($title['name']) ?>" required></dd>

                        <dt>Rating</dt>
                        <dd><input type="number" step="0.1" name="rating" class="input input-description" value="<?= $title['rating'] ?>" required></dd>

                        <dt>Tanggal Rilis</dt>
                        <dd><input type="date" name="release_date" class="input input-description" value="<?= $title['release_date'] ?>" required></dd>

                        <dt>Genre</dt>
                        <dd><input type="text" name="genre" class="input input-description" value="<?= htmlspecialchars($title['genre']) ?>" required></dd>

                        <dt>Penulis</dt>
                        <dd><input type="text" name="writer" class="input input-description" value="<?= htmlspecialchars($title['writer']) ?>" required></dd>

                        <dt>Studio</dt>
                        <dd><input type="text" name="studio" class="input input-description" value="<?= htmlspecialchars($title['studio']) ?>" required></dd>

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
                        <dd><input type="text" name="trailer_link" class="input input-description" value="<?= htmlspecialchars($title['trailer_link']) ?>" required></dd>

                        <dt>Sinopsis</dt>
                        <dd><textarea name="sinopsis" class="input input-description input-text-small" required><?= htmlspecialchars($title['sinopsis']) ?></textarea></dd>
                    </dl>
                </div>
                <div class="details-right">
                    <p><strong>DESKRIPSI:</strong></p>
                    <textarea name="description" class="input input-description input-text-big" required><?= htmlspecialchars($title['description']) ?></textarea>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="button1">Simpan Perubahan</button>
            </div>
        </form>
    <?php else: ?>
        <button id="suggest-details-button" class="button3">Sarankan Perubahan</button>
        <div id="suggest-details-form" style="display: none;">
            <input type="hidden" name="title_id" value="<?= $title_id ?>">
            <textarea id="suggestion-text" class="input input-description input-text-small" placeholder="Masukkan saran Anda disini..." required></textarea>
            <div class="button-container">
                <button type="button" id="submit-suggestion-button" class="button1">Kirim Saran</button>
                <button type="button" id="cancel-suggestion-button" class="button2">Batal</button>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<div id="confirmation-message" style="display: none;">
    <p>Terima kasih! Perubahan yang kamu ajukan akan ditinjau kembali oleh Admin!</p>
</div>
<div id="suggestions-list" style="display: none;">
    <h3>Saran Pengguna</h3>
    <button id="delete-all-suggestions-button" class="button3">Hapus Semua Saran</button>
    <div id="suggestions-container"></div>
</div>
<script>
    var title_id = <?= json_encode($title_id); ?>;
</script>
<script src="../assets/js/details_descriptions.js"></script>

