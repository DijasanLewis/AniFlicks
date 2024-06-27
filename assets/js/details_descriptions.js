document.addEventListener('DOMContentLoaded', function() {
    var editButton = document.getElementById('edit-details-button');
    var suggestButton = document.getElementById('suggest-details-button');
    var detailsForm = document.getElementById('edit-details-form');
    var suggestForm = document.getElementById('suggest-details-form');
    var detailsStatic = document.getElementById('details-static');
    var confirmationMessage = document.getElementById('confirmation-message');
    var submitSuggestionButton = document.getElementById('submit-suggestion-button');
    var cancelSuggestionButton = document.getElementById('cancel-suggestion-button');
    var suggestionText = document.getElementById('suggestion-text');
    var viewSuggestionsButton = document.getElementById('view-suggestions-button');
    var suggestionsList = document.getElementById('suggestions-list');
    var suggestionsContainer = document.getElementById('suggestions-container');
    var deleteAllSuggestionsButton = document.getElementById('delete-all-suggestions-button');

    var editMode = false;

    if (editButton) {
        editButton.addEventListener('click', function() {
            editMode = !editMode;
            if (editMode) {
                detailsStatic.style.display = 'none';
                detailsForm.style.display = 'grid';
                editButton.textContent = 'Batal';
                editButton.classList.remove('button1');
                editButton.classList.add('button3');
            } else {
                detailsForm.style.display = 'none';
                detailsStatic.style.display = 'grid';
                editButton.textContent = 'Edit Detail';
                editButton.classList.remove('button3');
                editButton.classList.add('button1');
            }
        });
    }

    if (suggestButton) {
        suggestButton.addEventListener('click', function() {
            suggestForm.style.display = 'block';
        });
    }

    if (cancelSuggestionButton) {
        cancelSuggestionButton.addEventListener('click', function() {
            suggestForm.style.display = 'none';
            suggestionText.value = '';
        });
    }

    if (submitSuggestionButton) {
        submitSuggestionButton.addEventListener('click', function() {
            var formData = new FormData();
            formData.append('title_id', title_id);
            formData.append('suggestion', suggestionText.value);
            fetch('../api/suggest_movie_update.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text()).then(data => {
                alert('Saran berhasil dikirim');
                suggestForm.style.display = 'none';
                confirmationMessage.style.display = 'block';
                setTimeout(() => {
                    confirmationMessage.style.display = 'none';
                }, 3000);
            }).catch(error => console.error('Error:', error));
        });
    }

    if (viewSuggestionsButton) {
        viewSuggestionsButton.addEventListener('click', function() {
            fetch('../admin/view_suggestions.php?title_id=' + title_id)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        suggestionsContainer.innerHTML = '';
                        data.suggestions.forEach(suggestion => {
                            var suggestionCard = document.createElement('div');
                            suggestionCard.classList.add('suggestion-card');
                            suggestionCard.innerHTML = `
                                <p><strong>User:</strong> ${suggestion.username}</p>
                                <p><strong>Tanggal:</strong> ${suggestion.created_at}</p>
                                <p><strong>Saran:</strong> ${suggestion.suggestion}</p>
                                <button class="delete-suggestion-button button3" data-id="${suggestion.id}">Hapus</button>
                            `;
                            suggestionsContainer.appendChild(suggestionCard);

                            var deleteButton = suggestionCard.querySelector('.delete-suggestion-button');
                            deleteButton.addEventListener('click', function() {
                                var suggestionId = this.getAttribute('data-id');
                                fetch('../admin/delete_suggestion.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ id: suggestionId })
                                }).then(response => response.json()).then(data => {
                                    if (data.success) {
                                        suggestionCard.remove();
                                    } else {
                                        alert('Gagal menghapus saran');
                                    }
                                }).catch(error => console.error('Error:', error));
                            });
                        });
                        suggestionsList.style.display = 'block';
                    } else {
                        alert('Gagal memuat saran');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }

    if (deleteAllSuggestionsButton) {
        deleteAllSuggestionsButton.addEventListener('click', function() {
            fetch('../admin/delete_all_suggestions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ title_id: title_id })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    suggestionsContainer.innerHTML = '';
                    suggestionsList.style.display = 'none';
                } else {
                    alert('Gagal menghapus semua saran');
                }
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
