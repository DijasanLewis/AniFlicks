document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menangani fungsionalitas tab
    function handleTabs() {
        var tabButtons = document.querySelectorAll('.tab-button');
        var tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var tab = this.getAttribute('data-tab');
                tabButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                tabContents.forEach(function(content) {
                    content.style.display = content.id === tab ? 'block' : 'none';
                });
                this.classList.add('active');
            });
        });
    }

    handleTabs();

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

    // Fungsi untuk menambahkan film ke watchlist
    function addToWatchlist(titleId) {
        console.log('Adding to watchlist:', titleId); // Log titleId
        fetch('../api/update_watchlist.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title_id: titleId })
        }).then(response => response.json()).then(data => {
            console.log('Response from server:', data); // Log response
            if (data.status === 'success') {
                alert('Film berhasil ditambahkan ke watchlist');
                location.reload();
            } else {
                alert(data.message);
            }
        }).catch(error => console.error('Error:', error));
    }

    // Fungsi untuk memperbarui rating film
    function updateRating(titleId, rating) {
        fetch('../api/update_rating.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title_id: titleId, rating: rating })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                alert('Rating berhasil diperbarui');
            } else {
                alert('Gagal memperbarui rating');
            }
        }).catch(error => console.error('Error:', error));
    }

    // Event listener untuk rating
    var ratingInputs = document.querySelectorAll('.rating input');
    ratingInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var titleId = this.getAttribute('data-title-id');
            var rating = this.value;
            updateRating(titleId, rating);
        });
    });

    // Fungsi untuk memuat lebih banyak ulasan
    function loadMoreReviews() {
        fetch(`../api/load_more_reviews.php?title_id=${titleId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var comments = document.getElementById('comments');
                    data.reviews.forEach(review => {
                        var reviewElement = document.createElement('div');
                        reviewElement.classList.add('review');
                        reviewElement.innerHTML = `<p><strong>${review.username}:</strong> ${review.comment}</p><p><small>Posted on: ${review.date_posted}</small></p>`;
                        comments.appendChild(reviewElement);
                    });
                } else {
                    alert('Gagal memuat ulasan tambahan');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listener untuk tombol "Load More Reviews"
    var loadMoreButton = document.getElementById('load-more-reviews-button');
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function(event) {
            event.preventDefault();
            loadMoreReviews();
        });
    }

    // Event listener untuk tombol "Hapus Film"
    var deleteButton = document.querySelector('.delete-movie-button');
    if (deleteButton) {
        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus film ini?')) {
                var titleId = this.getAttribute('data-title-id');
                deleteMovie(titleId);
            }
        });
    }

    // Fungsi untuk menghapus film
    function deleteMovie(titleId) {
        fetch('../api/delete_movie.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title_id: titleId })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                alert('Film berhasil dihapus');
                window.location.href = '../templates/catalog.php'; // Redirect to catalog page
            } else {
                alert('Gagal menghapus film');
            }
        }).catch(error => console.error('Error:', error));
    }
});
