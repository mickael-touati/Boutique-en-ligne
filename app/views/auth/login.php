<?php
require_once '../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = htmlspecialchars($_POST['mail']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE mail = ?";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->execute([$mail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: ../user/profile.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroShop - Connexion</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>
<body>
    <main class="auth-page">
        <div class="auth-card">
            <h1>Connexion</h1>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="mail">Email</label>
                    <input type="email" name="mail" id="mail" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="btn-submit">Connectez-vous</button>
                <p>Pas encore de compte ? <a href="register.php">inscrivez-vous</a></p>
            </form>
        </div>
    </main>
</body>
</html>