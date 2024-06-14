<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - AniFlicks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .profile-container {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .profile-card {
            width: 300px;
            background-color: #1e1e1e;
            border: 1px solid #333333;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .btn-edit, .btn-change-password {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff4500;
            border: none;
            color: white;
            cursor: pointer;
            display: block;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s;
        }

        .btn-edit:hover, .btn-change-password:hover {
            background-color: #e03e00;
        }

    </style>
</head>
<body>
    <header>
        <?php include("../includes/header.php"); ?>
    </header>
    <main style="margin-top: 5em; display: flex; justify-content: center;">
        <div class="profile-container">
            <div class="profile-card">
                <img src="<?= $_SESSION['profile_image'] ?>" alt="Profile Image" class="profile-pic">
                <h3><?= $_SESSION['username'] ?></h3>
                <p>Email: <?= $_SESSION['email'] ?></p>
                <button class="btn-edit">Edit Profile</button>
                <button class="btn-change-password">Change Password</button>
            </div>
        </div>
    </main>
    <footer>
        <?php include("../includes/footer.php"); ?>
    </footer>
</body>
</html>
