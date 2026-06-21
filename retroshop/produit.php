<?php
session_start();
require_once __DIR__ . '/../app/views/config/database.php';

$pdo = $db->getConnection();

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $produit['name']; ?> — RetroShop</title>
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
      <a href="#">Panier</a>
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

<main class="detail">

  <div class="detail-img">
    <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['name']; ?>">
  </div>

  <div class="detail-info">
    <?php if ($produit['promo']) : ?>
      <span class="promo">Promo</span>
    <?php endif; ?>
    <h1 class="detail-nom"><?php echo $produit['name']; ?></h1>
    <p class="detail-prix"><?php echo $produit['price']; ?> €</p>
    <p class="detail-desc"><?php echo $produit['description']; ?></p>
    <p class="detail-stock">Stock disponible : <?php echo $produit['stock']; ?></p>
    <a href="#" class="carte-btn">Ajouter au panier</a>
  </div>

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