<?php
require_once('../includes/config.php');

$conn = db_connect();
$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$biodata = $_POST['biodata'];
$profile_image = $_FILES['profile_image']['name'];

if ($profile_image) {
    $target_dir = "../assets/images/user_profiles/";
    $target_file = $target_dir . basename($profile_image);
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
        $profile_image_path = $target_file;
    } else {
        $_SESSION['profile_update_message'] = "Gagal mengunggah foto profil.";
        header('Location: ../templates/profile.php');
        exit();
    }
} else {
    $profile_image_path = $_SESSION['profile_image'];
}

$sql = "UPDATE users SET username = ?, email = ?, biodata = ?, profile_image = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $username, $email, $biodata, $profile_image_path, $user_id);

if ($stmt->execute()) {
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['biodata'] = $biodata;
    $_SESSION['profile_image'] = $profile_image_path;
    $_SESSION['profile_update_message'] = "Profil berhasil diperbarui.";
} else {
    $_SESSION['profile_update_message'] = "Gagal memperbarui profil.";
}

header('Location: ../templates/profile.php');
exit();
?>
