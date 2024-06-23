<?php
$is_admin = $_SESSION['is_admin'] ?? false;
$is_logged_in = isset($_SESSION['user_id']);
?>

<h2>Karakter</h2>
<?php if ($is_logged_in && $is_admin): ?>
    <button id="edit-characters-button">Edit Karakter</button>
    <button id="view-character-suggestions-button" data-title-id="<?= $title_id ?>">Lihat Saran Karakter</button>
<?php elseif ($is_logged_in): ?>
    <button id="suggest-characters-button">Sarankan Perubahan</button>
<?php endif; ?>
<div class="cards" id="characters-static">
    <?php while($char = $characters->fetch_assoc()): ?>
        <div class="card" data-id="<?= $char['character_id'] ?>">
            <img src="<?= $char['image_path'] ?>" alt="<?= htmlspecialchars($char['name']) ?>">
            <div class="card-content">
                <h3><?= htmlspecialchars($char['name']) ?></h3>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<form id="characters-edit-form" method="POST" enctype="multipart/form-data" style="display: none;">
    <input type="hidden" name="title_id" value="<?= $title_id ?>">
    <input type="hidden" name="delete_character_id" id="delete-character-ids">
    <div class="cards" id="characters-edit-cards">
        <?php $characters->data_seek(0); while($char = $characters->fetch_assoc()): ?>
            <div class="card" data-id="<?= $char['character_id'] ?>">
                <input type="hidden" name="character_id[]" value="<?= $char['character_id'] ?>">
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
    <button type="button" id="save-characters-button">Simpan Perubahan</button>
</form>
<div id="character-suggestions" style="display: none;">
    <h3>Saran Karakter</h3>
    <div class="cards" id="suggestion-cards"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButton = document.getElementById('edit-characters-button');
        var suggestButton = document.getElementById('suggest-characters-button');
        var charactersStatic = document.getElementById('characters-static');
        var charactersEditForm = document.getElementById('characters-edit-form');
        var addCharacterButton = document.getElementById('add-character-button');
        var saveCharactersButton = document.getElementById('save-characters-button');
        var viewCharacterSuggestionsButton = document.getElementById('view-character-suggestions-button');
        var deleteCharacterIdsInput = document.getElementById('delete-character-ids');

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
                <input type="hidden" name="current_image_path[]" value="">
                <img src="#" alt="New Character" class="character-image">
                <input type="file" name="character_image[]" class="character-image-input" data-id="new" style="display: none;">
                <div class="card-content">
                    <input type="text" name="character_name[]" placeholder="Nama Karakter">
                    <button type="button" class="change-image-button" data-id="new" style="display: block;">Ganti Gambar</button>
                    <button type="button" class="delete-character-button" data-id="new" style="display: block;">Hapus Karakter</button>
                </div>
            `;
            document.getElementById('characters-edit-cards').appendChild(newCard);

            newCard.querySelector('.change-image-button').addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                document.querySelector('.character-image-input[data-id="' + id + '"]').click();
            });

            newCard.querySelector('.character-image-input').addEventListener('change', function() {
                var reader = new FileReader();
                var id = this.getAttribute('data-id');
                reader.onload = function(e) {
                    newCard.querySelector('.character-image').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            });

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

        document.querySelectorAll('.delete-character-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                if (id === 'new') {
                    this.closest('.card').remove();
                } else {
                    var deleteIds = deleteCharacterIdsInput.value ? deleteCharacterIdsInput.value.split(',') : [];
                    deleteIds.push(id);
                    deleteCharacterIdsInput.value = deleteIds.join(',');
                    this.closest('.card').remove();
                }
            });
        });

        if (viewCharacterSuggestionsButton) {
            viewCharacterSuggestionsButton.addEventListener('click', function() {
                var titleId = this.getAttribute('data-title-id');
                fetch(`../admin/view_character_suggestions.php?title_id=${titleId}`)
                    .then(response => {
                        console.log('Response status:', response.status); // Debugging log
                        return response.json().catch(() => {
                            throw new Error('Invalid JSON');
                        });
                    })
                    .then(data => {
                        if (data.success) {
                            var suggestionCards = document.getElementById('suggestion-cards');
                            suggestionCards.innerHTML = '';
                            data.suggestions.forEach(suggestion => {
                                var card = document.createElement('div');
                                card.classList.add('card');
                                card.innerHTML = `
                                    <img src="${suggestion.image_path}" alt="${suggestion.name}">
                                    <div class="card-content">
                                        <h3>${suggestion.name}</h3>
                                        <button type="button" class="add-character-button" data-id="${suggestion.id}">Tambah Karakter</button>
                                        <button type="button" class="delete-suggestion-button" data-id="${suggestion.id}">Hapus Saran</button>
                                    </div>
                                `;
                                suggestionCards.appendChild(card);
                            });

                            document.querySelectorAll('.add-character-button').forEach(button => {
                                button.addEventListener('click', function() {
                                    var characterId = this.getAttribute('data-id');
                                    console.log('Adding character with suggestion ID:', characterId); // Debugging log
                                    fetch('../admin/add_character_from_suggestion.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({ character_id: characterId })
                                    }).then(response => {
                                        console.log('Response status:', response.status); // Debugging log
                                        return response.json().catch(() => {
                                            throw new Error('Invalid JSON');
                                        });
                                    }).then(data => {
                                        console.log('Response from server:', data); // Debugging log
                                        if (data.success) {
                                            alert('Karakter berhasil ditambahkan');
                                            location.reload();
                                        } else {
                                            alert('Gagal menambahkan karakter: ' + data.message);
                                        }
                                    }).catch(error => {
                                        console.error('Error:', error);
                                        alert('Terjadi kesalahan pada server. Periksa log untuk detail lebih lanjut.');
                                    });
                                });
                            });

                            document.querySelectorAll('.delete-suggestion-button').forEach(button => {
                                button.addEventListener('click', function() {
                                    var suggestionId = this.getAttribute('data-id');
                                    console.log('Deleting suggestion with ID:', suggestionId); // Debugging log
                                    fetch('../admin/delete_character_suggestion.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({ suggestion_id: suggestionId })
                                    }).then(response => {
                                        console.log('Response status:', response.status); // Debugging log
                                        return response.json().catch(() => {
                                            throw new Error('Invalid JSON');
                                        });
                                    }).then(data => {
                                        console.log('Response from server:', data); // Debugging log
                                        if (data.success) {
                                            alert('Saran berhasil dihapus');
                                            this.closest('.card').remove();
                                        } else {
                                            alert('Gagal menghapus saran');
                                        }
                                    }).catch(error => {
                                        console.error('Error:', error);
                                        alert('Terjadi kesalahan pada server. Periksa log untuk detail lebih lanjut.');
                                    });
                                });
                            });

                            document.getElementById('character-suggestions').style.display = 'block';
                        } else {
                            alert('Gagal memuat saran karakter');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        // Fungsi untuk menyimpan perubahan karakter
        saveCharactersButton.addEventListener('click', function() {
            var formData = new FormData(charactersEditForm);
            var actionUrl = charactersEditForm.action === '../api/suggest_character_update.php' ? '../api/suggest_character_update.php' : '../admin/update_characters.php';
            fetch(actionUrl, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert('Perubahan berhasil disimpan');
                    location.reload();
                } else {
                    alert('Gagal menyimpan perubahan: ' + data.message);
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada server. Periksa log untuk detail lebih lanjut.');
            });
        });
    });
</script>
