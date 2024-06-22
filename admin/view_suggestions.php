<?php
require_once('../includes/movie_function.php');

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

function get_suggestions_by_title_id($title_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM temporary_titles WHERE title_id = ?");
    $stmt->bind_param("i", $title_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $suggestions = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $suggestions;
}

function get_username_by_user_id($user_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $username = null;
    if ($row = $result->fetch_assoc()) {
        $username = $row['username'];
    }
    $stmt->close();
    return $username;
}

$title_id = $_GET['title_id'] ?? 0;
$title = get_movie_details($title_id)['name'];
$suggestions = get_suggestions_by_title_id($title_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saran untuk <?= htmlspecialchars($title) ?> - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <h1>Saran untuk <?= htmlspecialchars($title) ?></h1>
        <?php if (count($suggestions) > 0): ?>
            <?php foreach ($suggestions as $suggestion): ?>
                <div class="suggestion">
                    <?php $username = get_username_by_user_id($suggestion['user_id']) ?>
                    <h2>SARAN DARI USER BERNAMA <?= $username ?> DENGAN ID: <?= htmlspecialchars($suggestion['user_id']) ?></h2>
                    <form action="../admin/update_movie.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="title_id" value="<?= $title_id ?>">
                        <input type="hidden" name="suggestion_id" value="<?= $suggestion['id'] ?>">
                        <div class="details-grid">
                            <div class="details-left">
                                <dl>
                                    <dt>Judul</dt>
                                    <dd><input type="text" name="name" value="<?= htmlspecialchars($suggestion['name']) ?>" required></dd>

                                    <dt>Rating</dt>
                                    <dd><input type="number" step="0.1" name="rating" value="<?= htmlspecialchars($suggestion['rating']) ?>" required></dd>

                                    <dt>Tanggal Rilis</dt>
                                    <dd><input type="date" name="release_date" value="<?= $suggestion['release_date'] ?>" required></dd>

                                    <dt>Genre</dt>
                                    <dd><input type="text" name="genre" value="<?= htmlspecialchars($suggestion['genre']) ?>" required></dd>

                                    <dt>Penulis</dt>
                                    <dd><input type="text" name="writer" value="<?= htmlspecialchars($suggestion['writer']) ?>" required></dd>

                                    <dt>Studio</dt>
                                    <dd><input type="text" name="studio" value="<?= htmlspecialchars($suggestion['studio']) ?>" required></dd>

                                    <dt>Poster</dt>
                                    <dd>
                                        <input type="hidden" name="poster_path" value="<?= htmlspecialchars($suggestion['poster_path']) ?>">
                                        <input type="file" name="poster_path_file" id="poster_path_<?= $suggestion['id'] ?>">
                                        <img id="poster_preview_<?= $suggestion['id'] ?>" src="<?= htmlspecialchars($suggestion['poster_path']) ?>" alt="Poster Preview" style="width: 100px;">
                                    </dd>

                                    <dt>Background</dt>
                                    <dd>
                                        <input type="hidden" name="background_path" value="<?= htmlspecialchars($suggestion['background_path']) ?>">
                                        <input type="file" name="background_path_file" id="background_path_<?= $suggestion['id'] ?>">
                                        <img id="background_preview_<?= $suggestion['id'] ?>" src="<?= htmlspecialchars($suggestion['background_path']) ?>" alt="Background Preview" style="width: 100px;">
                                    </dd>

                                    <dt>Trailer Link</dt>
                                    <dd><input type="text" name="trailer_link" value="<?= htmlspecialchars($suggestion['trailer_link']) ?>" required></dd>

                                    <dt>Sinopsis</dt>
                                    <dd><textarea name="sinopsis" required><?= htmlspecialchars($suggestion['sinopsis']) ?></textarea></dd>
                                </dl>
                            </div>
                            <div class="details-right">
                                <p><strong>DESKRIPSI:</strong></p>
                                <textarea name="description" required><?= htmlspecialchars($suggestion['description']) ?></textarea>
                            </div>
                        </div>
                        <button type="submit" name="accept_suggestion" value="1">Terima Perubahan</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada saran untuk judul ini.</p>
        <?php endif; ?>
    </main>
    <?php include("../includes/footer.php") ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"]').forEach(function(input) {
                input.addEventListener('change', function(event) {
                    var previewId = input.id.replace('path', 'preview');
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(previewId).src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        });
    </script>
</body>
</html>
