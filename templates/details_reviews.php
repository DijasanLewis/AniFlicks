<h2>ULASAN</h2>
<form id="comment-form">
    <textarea id="comment" name="comment" placeholder="Add your comment" required></textarea>
    <button type="submit">Beri Komentar</button>
</form>
<div id="comments">
    <?php while($review = $reviews->fetch_assoc()): ?>
        <div class="review">
            <p><strong><?= htmlspecialchars($review['username']) ?>:</strong> <?= htmlspecialchars($review['comment']) ?></p>
            <p><small>Posted on: <?= $review['date_posted'] ?></small></p>
        </div>
    <?php endwhile; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var commentForm = document.getElementById('comment-form');
    commentForm.addEventListener('submit', function(event) {
        event.preventDefault();
        var comment = document.getElementById('comment').value;
        addComment(comment);
    });

    function addComment(comment) {
        var titleId = document.querySelector('main').getAttribute('data-title-id');
        fetch('../api/add_comment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title_id: titleId, comment: comment })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                alert('Komentar berhasil ditambahkan');
                location.reload();
            } else {
                alert('Gagal menambahkan komentar');
            }
        }).catch(error => console.error('Error:', error));
    }
});

</script>