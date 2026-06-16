<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password === $confirm) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (name, mail, password, role) VALUES (?, ?, ?, 'client')";
        $stmt = $db->getConnection()->prepare($sql);
        
        if ($stmt->execute([$name, $mail, $hashed])) {
            header('Location: login.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroShop - Inscription</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>
<body>
    <main class="auth-page">
        <div class="auth-card">
            <h1>Inscription</h1>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="name">Nom complet</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-group">
                    <label for="mail">Email</label>
                    <input type="email" name="mail" id="mail" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit" class="btn-submit">Inscrivez-vous</button>
                <p>Vous avez déjà un compte ? <a href="login.php">connectez-vous</a></p>
            </form>
        </div>
    </main>
</body>
</html>