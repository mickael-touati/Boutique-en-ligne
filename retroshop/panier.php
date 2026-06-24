<?php
session_start();
require_once __DIR__ . '/../app/views/config/database.php';

$pdo = $db->getConnection();

if (!isset($_SESSION['user'])) {
    header('Location: ../app/views/auth/login.php');
    exit();
}

$user_id = $_SESSION['user']['id'];
$total = 0;
$produits = [];

$stmt = $pdo->prepare("
    SELECT article.*, panier.quantite 
    FROM panier 
    JOIN article ON panier.article_id = article.id 
    WHERE panier.user_id = ?
");
$stmt->execute([$user_id]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($produits as $produit) {
    $total = $total + ($produit['price'] * $produit['quantite']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier — RetroShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Lexend:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <a href="index.php" class="header_logo">Retro<span>Shop</span></a>
    <nav class="header_nav" aria-label="Navigation principale">
      <a href="boutique.php">Boutique</a>
      <a href="panier.php">Panier</a>
      <?php if (isset($_SESSION['user'])) { ?>
          <a href="../app/views/auth/profile.php">Mon profil</a>
      <?php } else { ?>
          <a href="../app/views/auth/login.php">Connexion</a>
      <?php } ?>
      <?php if (isset($_SESSION['admin'])) { ?>
          <a href="../admin/dashboard.php">Admin</a>
      <?php } ?>
    </nav>
</header>

<main class="panier">
    <h1 class="panier-titre">Mon Panier</h1>

    <?php if (count($produits) == 0) { ?>
        <p class="panier-vide">Votre panier est vide</p>
    <?php } else { ?>

    <div class="panier-liste">
        <?php foreach ($produits as $produit) { ?>
            <div class="panier-item">
                <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['name']; ?>">
                <div class="panier-item-info">
                    <h3><?php echo $produit['name']; ?></h3>
                    <p><?php echo $produit['price']; ?> €</p>
                    <p>Quantité : <?php echo $produit['quantite']; ?></p>
                </div>
                <div class="panier-item-total">
                    <p><?php echo $produit['price'] * $produit['quantite']; ?> €</p>
                    <a href="panier-supprimer.php?id=<?php echo $produit['id']; ?>">Supprimer</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="panier-total">
        <h2>Total : <?php echo $total; ?> €</h2>
        <a href="#" class="carte-btn">Commander</a>
    </div>

    <?php } ?>
</main>

<footer class="footer">
    <p>© 2025 RetroShop — Tous droits réservés</p>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="boutique.php">Boutique</a>
        <a href="#">Contact</a>
    </nav>
</footer>

</body>
</html>