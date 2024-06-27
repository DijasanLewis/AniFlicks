<?php
require_once '../includes/config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>
    <?php include("../includes/header.php"); ?>
    <div class="content-wrapper">
        <?php if (isset($_SESSION['password_change_message'])): ?>
            <div class="notification <?= strpos($_SESSION['password_change_message'], 'berhasil') !== false ? 'notification-success' : 'notification-error' ?>">
                <?= $_SESSION['password_change_message']; unset($_SESSION['password_change_message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['profile_update_message'])): ?>
            <div class="notification <?= strpos($_SESSION['profile_update_message'], 'berhasil') !== false ? 'notification-success' : 'notification-error' ?>">
                <?= $_SESSION['profile_update_message']; unset($_SESSION['profile_update_message']); ?>
            </div>
        <?php endif; ?>
        <div class="profile-container">
            <div class="profile-card" id="profileCard">
                <img src="<?= $_SESSION['profile_image'] ?>" alt="Profile Image" class="profile-picture">
                <h3 class="profile-name"><?= $_SESSION['username'] ?></h3>
                <hr class="profile-divider">
                <p class="profile-email"><?= $_SESSION['email'] ?></p>
                <p class="profile-biodata"><?= $_SESSION['biodata'] ?></p>
                <button class="button1" onclick="toggleEditForm()">Edit Profil</button>
                <button class="button1" onclick="togglePasswordForm()">Ganti Kata Sandi</button>
                <?php if ($_SESSION['is_admin']): ?>
                    <button class="button3" onclick="window.location.href='../admin/user_list.php'">Daftar User</button>
                <?php endif; ?>
            </div>
            <div class="edit-card hidden" id="editCard">
                <form action="../user/update_profile.php" method="post" enctype="multipart/form-data">
                    <div class="field">
                        <label for="profile_image" class="button1">Kirim Foto</label>
                        <input type="file" name="profile_image" id="profile_image" class="input-field hidden" onchange="previewImage(event)">
                    </div>
                    <div class="field">
                        <img id="profile_image_preview" src="#" alt="Image Preview" class="hidden profile-picture" style="margin-bottom: 20px;">
                    </div>
                    <div class="field">
                        <input type="text" name="username" value="<?= $_SESSION['username'] ?>" required placeholder="Username" class="input-field">
                    </div>
                    <div class="field">
                        <input type="email" name="email" value="<?= $_SESSION['email'] ?>" required placeholder="Email" class="input-field">
                    </div>
                    <div class="field">
                        <textarea name="biodata" placeholder="Biodata" class="input-field"><?= $_SESSION['biodata'] ?></textarea>
                    </div>
                    <div class="btn">
                        <button type="submit" class="button1">Simpan Perubahan</button>
                        <button type="button" class="button3" onclick="toggleEditForm()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="overlay hidden" id="passwordOverlay">
        <div class="password-card">
            <form action="../user/change_password.php" method="post">
                <div class="field">
                    <input type="password" name="current_password" placeholder="Current Password" required class="input-field">
                </div>
                <div class="field">
                    <input type="password" name="new_password" placeholder="New Password" required class="input-field">
                </div>
                <div class="field">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required class="input-field">
                </div>
                <div class="btn">
                    <button type="submit" class="button1">Perbarui Kata Sandi</button>
                    <button type="button" class="button3" onclick="togglePasswordForm()">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <?php include("../includes/footer.php"); ?>
    <script src="../assets/js/profile.js"></script>
</body>
</html>
