<?php
require_once('../includes/movie_function.php'); // Load fungsi-fungsi film

$characters = get_movie_characters($title_id); // Ambil karakter-karakter dari film berdasarkan title_id
?>

<h2>Karakter</h2>
<?php if ($is_logged_in && $is_admin): ?>
    <!-- Tombol untuk admin untuk mengedit karakter -->
    <button id="edit-characters-button" class="button1">Edit Karakter</button>
    <!-- Tombol untuk admin untuk melihat saran karakter -->
    <button id="view-character-suggestions-button" data-title-id="<?= $title_id ?>" class="button2">Lihat Saran Karakter</button>
<?php elseif ($is_logged_in): ?>
    <!-- Tombol untuk user biasa untuk menambah saran karakter -->
    <button id="suggest-characters-button" class="button1">Tambah Saran Karakter</button>
<?php endif; ?>
<div class="cards" id="characters-static">
    <!-- Loop untuk menampilkan karakter-karakter yang ada -->
    <?php while($char = $characters->fetch_assoc()): ?>
        <div class="card" data-id="<?= $char['character_id'] ?>">
            <img src="<?= $char['image_path'] ?>" alt="<?= htmlspecialchars($char['name']) ?>">
            <div class="card-content">
                <h3><?= htmlspecialchars($char['name']) ?></h3>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php if ($is_logged_in): ?>
<form id="characters-edit-form" method="POST" enctype="multipart/form-data" style="display: none;">
    <input type="hidden" name="title_id" value="<?= $title_id ?>">
    <input type="hidden" name="delete_character_id" id="delete-character-ids">
    <div class="cards" id="characters-edit-cards">
        <!-- Bagian untuk admin untuk mengedit karakter-karakter yang ada -->
        <?php if ($is_admin): ?>
            <?php $characters->data_seek(0); while($char = $characters->fetch_assoc()): ?>
                <div class="card" data-id="<?= $char['character_id'] ?>">
                    <input type="hidden" name="character_id[]" value="<?= $char['character_id'] ?>">
                    <input type="hidden" name="current_image_path[]" value="<?= $char['image_path'] ?>">
                    <img src="<?= $char['image_path'] ?>" alt="<?= htmlspecialchars($char['name']) ?>" id="character_image_<?= $char['character_id'] ?>" class="character-image">
                    <input type="file" name="character_image[]" class="character-image-input" data-id="<?= $char['character_id'] ?>" style="display: none;">
                    <div class="card-content">
                        <input type="text" name="character_name[]" value="<?= htmlspecialchars($char['name']) ?>" class="input-field editable-admin-only input input-description">
                        <button type="button" class="change-image-button button2 editable-admin-only" data-id="<?= $char['character_id'] ?>" style="display: none;">Ganti Gambar</button>
                        <button type="button" class="delete-character-button button3 editable-admin-only" data-id="<?= $char['character_id'] ?>" style="display: none;">Hapus Karakter</button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="button-container">
        <!-- Tombol untuk menambah karakter baru -->
        <button type="button" id="add-character-button" class="button1">Tambah Karakter</button>
        <!-- Tombol untuk menyimpan perubahan -->
        <button type="button" id="save-characters-button" class="button1">Simpan</button>
        <!-- Tombol untuk membatalkan edit -->
        <button type="button" id="cancel-edit-button" class="button3">Batal</button>
    </div>
</form>
<?php endif; ?>
<div id="character-suggestions" style="display: none;">
    <h3>Saran Karakter</h3>
    <div class="cards" id="suggestion-cards"></div>
</div>
<script>
    var isAdmin = <?= json_encode($is_admin); ?>;
</script>
<script src="../assets/js/details_characters.js"></script>
