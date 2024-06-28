<?php
require_once('../includes/config.php');
if (!$_SESSION['is_admin']) {
    header('Location: profile.php');
    exit();
}
$conn = db_connect();
$sql = "SELECT user_id, username, email, is_admin FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/user_list.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>
    <main class="main-container">
        <div class="container">
            <h2>Daftar User</h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['is_admin'] ? 'Yes' : 'No' ?></td>
                            <td>
                                <?php if (!$row['is_admin']): ?>
                                    <form action="make_admin.php" method="post">
                                        <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                        <button type="submit" class="button1">Jadikan Admin</button>
                                    </form>
                                <?php else: ?>
                                    <form action="remove_admin.php" method="post">
                                        <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                        <button type="submit" class="button3">Jadikan User Biasa</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include("../includes/footer.php"); ?>
</body>
</html>
