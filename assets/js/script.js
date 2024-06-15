document.addEventListener("DOMContentLoaded", function() {
    var videoContainer = document.getElementById('background-video');
    var image = document.getElementById('background-image');
    var iframe = videoContainer.querySelector('iframe');

    if (iframe) {
        iframe.onload = function() {
            image.style.display = 'none';
            videoContainer.style.display = 'block';
        };
    }
});

function addToWatchlist(titleId) {
    var formData = new FormData();
    formData.append('title_id', titleId);

    fetch('../api/update_watchlist.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Tampilkan notifikasi sebagai alert, atau gunakan elemen HTML untuk notifikasi
    })
    .catch(error => console.error('Error:', error));
}

function updateRating(titleId, rating) {
    var formData = new FormData();
    formData.append('title_id', titleId);
    formData.append('rating', rating);

    fetch('../api/update_rating.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function addComment(titleId, comment) {
    var formData = new FormData();
    formData.append('title_id', titleId);
    formData.append('comment', comment);

    fetch('../api/add_comment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}