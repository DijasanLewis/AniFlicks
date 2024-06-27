<?php
require_once '../includes/config.php';

if (!$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

$conn = db_connect();
$sql = "SELECT ts.*, u.username FROM temporary_titles ts JOIN users u ON ts.user_id = u.user_id";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <h2>Film yang Disarankan</h2>
        <div class="suggestions-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="suggestion-card">';
                    echo '<img src="' . $row["poster_path"] . '" alt="' . $row["name"] . '">';
                    echo '<div class="suggestion-content">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>' . $row["genre"] . '</p>';
                    echo '<p>' . $row["username"] . '</p>';
                    echo '<p>' . $row["release_date"] . '</p>';
                    echo '<button class="approve-button" data-id="' . $row["id"] . '">Approve</button>';
                    echo '<button class="delete-button" data-id="' . $row["id"] . '">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No suggestions found.</p>';
            }
            ?>
        </div>
    </main>
    <?php include("../includes/footer.php") ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.approve-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                fetch('../admin/approve_title_suggestion.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert('Title approved successfully!');
                        location.reload();
                    } else {
                        alert('Failed to approve title.');
                    }
                }).catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                fetch('../admin/delete_title_suggestion.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert('Title deleted successfully!');
                        location.reload();
                    } else {
                        alert('Failed to delete title.');
                    }
                }).catch(error => console.error('Error:', error));
            });
        });
    });
    </script>
</body>
</html>

