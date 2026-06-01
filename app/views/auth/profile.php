<?php
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $address = htmlspecialchars($_POST['address']);
    $id = $_SESSION['user']['id'];

    $sql = "UPDATE user SET name = ?, mail = ?, address = ? WHERE id = ?";
    $stmt = $db->getConnection()->prepare($sql);
    
    if ($stmt->execute([$name, $mail, $address, $id])) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['mail'] = $mail;
        $_SESSION['user']['address'] = $address;
    }
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroShop - Mon Profil</title>
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
</head>
<body>
    <div class="layout-profile">
        <nav class="side-menu">
            <button class="active">Mon profil</button>
            <button>Mes commandes</button>
            <button>Mon panier</button>
            <a href="../auth/logout.php" class="btn-exit">Se déconnecter</a>
        </nav>

        <section class="main-profile">
            <form action="" method="POST" class="profile-box">
                <h2>Mes informations</h2>
                <div class="header-user">
                    <div class="details-user">
                        <h3><?= htmlspecialchars($user['name']) ?></h3>
                        <p><?= htmlspecialchars($user['mail']) ?></p>
                    </div>
                    <button type="submit" class="btn-action">Enregistrer</button>
                </div>
                <div class="grid-fields">
                    <div class="field">
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>">
                    </div>
                    <div class="field">
                        <label for="mail">Email</label>
                        <input type="email" name="mail" id="mail" value="<?= htmlspecialchars($user['mail']) ?>">
                    </div>
                    <div class="field">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" id="address" value="<?= htmlspecialchars($user['address']) ?>">
                    </div>
                </div>
            </form>

            <div class="profile-box">
                <h2>Historique de commandes</h2>
                <div class="list-empty">
                    <p>Aucune commande enregistrée.</p>
                </div>
            </div>
        </section>
    </div>
</body>
</html> 