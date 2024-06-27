<h2>ULASAN</h2>
<form id="comment-form">
    <textarea id="comment" name="comment" class="input input-description input-text-small" placeholder="Tambahkan komentar Anda" required></textarea>
    <br>
    <button type="submit" class="button1">Beri Komentar</button>
</form>
<div id="comments">
    <?php while($review = $reviews->fetch_assoc()): ?>
        <div class="review">
            <p><strong><?= htmlspecialchars($review['username']) ?>:</strong> <?= htmlspecialchars($review['comment']) ?></p>
            <small>...<?= $review['date_posted'] ?></small>
        </div>
    <?php endwhile; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var commentForm = document.getElementById('comment-form');
    var titleId = <?= json_encode($title_id); ?>;

    commentForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var comment = document.getElementById('comment').value;
        addComment(comment);
    });

    function addComment(comment) {
        fetch('../api/add_comment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title_id: titleId, comment: comment })
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                alert('Komentar berhasil ditambahkan');
                location.reload();
            } else {
                alert('Gagal menambahkan komentar: ' + data.message);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server. Periksa log untuk detail lebih lanjut.');
        });
    }
});
</script>
