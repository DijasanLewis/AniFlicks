document.addEventListener('DOMContentLoaded', () => {
    const editPopup = document.getElementById('edit-popup');
    const closePopupButton = document.getElementById('close-popup');
    let currentTitleId;

    // Mencegah link <a> diikuti saat tombol ditekan
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', event => {
            const editButton = event.target.closest('.edit-button');
            const removeButton = event.target.closest('.remove-button');

            if (editButton || removeButton) {
                event.preventDefault();  // Mencegah navigasi ke details.php
            }

            if (editButton) {
                currentTitleId = card.getAttribute('data-title-id');
                showPopup();
            }

            if (removeButton) {
                const titleId = card.getAttribute('data-title-id');
                removeFromWatchlist(titleId);
            }
        });
    });

    function showPopup() {
        editPopup.style.display = 'flex'; // Tampilkan pop-up
    }

    function hidePopup() {
        editPopup.style.display = 'none'; // Sembunyikan pop-up
    }

    closePopupButton.addEventListener('click', hidePopup);

    document.querySelectorAll('.popup-button').forEach(button => {
        button.addEventListener('click', event => {
            const newStatus = event.target.getAttribute('data-status');
            if (newStatus) {
                editStatus(currentTitleId, newStatus);
                hidePopup();
            }
        });
    });

    function editStatus(titleId, newStatus) {
        fetch('../api/edit_watchlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'title_id=' + encodeURIComponent(titleId) + '&new_status=' + encodeURIComponent(newStatus)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                window.location.reload();  // Reload halaman untuk menampilkan data terbaru
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function removeFromWatchlist(titleId) {
        if (!confirm("Anda yakin ingin menghapus film ini dari daftar tontonan?")) return;

        fetch('../api/remove_from_watchlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'title_id=' + encodeURIComponent(titleId)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                window.location.reload();  // Reload halaman untuk menghapus card yang dihapus
            }
        })
        .catch(error => console.error('Error:', error));
    }
});