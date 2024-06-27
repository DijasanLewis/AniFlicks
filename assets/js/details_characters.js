document.addEventListener('DOMContentLoaded', function() {
    var editButton = document.getElementById('edit-characters-button');
    var suggestButton = document.getElementById('suggest-characters-button');
    var charactersStatic = document.getElementById('characters-static');
    var charactersEditForm = document.getElementById('characters-edit-form');
    var addCharacterButton = document.getElementById('add-character-button');
    var saveCharactersButton = document.getElementById('save-characters-button');
    var cancelEditButton = document.getElementById('cancel-edit-button');
    var viewCharacterSuggestionsButton = document.getElementById('view-character-suggestions-button');
    var deleteCharacterIdsInput = document.getElementById('delete-character-ids');

    function toggleEditForm(display) {
        if (isAdmin) {
            charactersStatic.style.display = display ? 'none' : 'flex';
        }
        charactersEditForm.style.display = display ? 'grid' : 'none';
        if (isAdmin) {
            document.querySelectorAll('.editable-admin-only').forEach(button => button.style.display = display ? 'block' : 'none');
        }
    }

    if (editButton) {
        editButton.addEventListener('click', function() {
            toggleEditForm(true);
            charactersEditForm.action = '../admin/update_characters.php';
        });
    }

    if (suggestButton) {
        suggestButton.addEventListener('click', function() {
            toggleEditForm(true);
            saveCharactersButton.textContent = 'Sarankan Perubahan';
            charactersEditForm.action = '../api/suggest_character_update.php';
            if (!isAdmin) {
                document.querySelectorAll('.editable-admin-only').forEach(button => button.style.display = 'none');
            }
        });
    }

    cancelEditButton.addEventListener('click', function() {
        toggleEditForm(false);
    });

    addCharacterButton.addEventListener('click', function() {
        var newCard = document.createElement('div');
        newCard.classList.add('card');
        newCard.innerHTML = `
            <input type="hidden" name="character_id[]" value="new">
            <input type="hidden" name="current_image_path[]" value="">
            <img src="#" alt="New Character" class="character-image">
            <input type="file" name="character_image[]" class="character-image-input" data-id="new" style="display: none;">
            <div class="card-content">
                <input type="text" name="character_name[]" placeholder="Nama Karakter" class="input-field">
                <button type="button" class="change-image-button button2" data-id="new" style="display: block;">Ganti Gambar</button>
                <button type="button" class="delete-character-button button3" data-id="new" style="display: block;">Hapus Karakter</button>
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
                .then(response => response.json())
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
                                    <button type="button" class="add-character-button button1" data-id="${suggestion.id}">Tambah Karakter</button>
                                    <button type="button" class="delete-suggestion-button button3" data-id="${suggestion.id}">Hapus Saran</button>
                                </div>
                            `;
                            suggestionCards.appendChild(card);
                        });

                        document.querySelectorAll('.add-character-button').forEach(button => {
                            button.addEventListener('click', function() {
                                var characterId = this.getAttribute('data-id');
                                fetch('../admin/add_character_from_suggestion.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ character_id: characterId })
                                }).then(response => response.json()).then(data => {
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
                                fetch('../admin/delete_character_suggestion.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ suggestion_id: suggestionId })
                                }).then(response => response.json()).then(data => {
                                    if (data.success) {
                                        alert('Saran berhasil dihapus');
                                        this.closest('.card').remove();
                                    } else {
                                        alert('Gagal menghapus saran');
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                    // alert('Terjadi kesalahan pada server. Periksa log untuk detail lebih lanjut.');
                                    this.closest('.card').remove(); 
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
        var actionUrl = isAdmin ? '../admin/update_characters.php' : '../api/suggest_character_update.php';
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
