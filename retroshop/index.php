<?php
session_start();
require_once __DIR__ . '/../app/views/config/database.php';

$pdo = $db->getConnection();

$stmt = $pdo->query("SELECT * FROM article LIMIT 4");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RetroShop</title>
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

  <section class="banniere">
    <div class="banniere_contenu">
        <h1 class="banniere_titre">Retrouve tes consoles et jeux video</h1>
        <p class="banniere_description">PS5, Nintendo switch. Et tout les jeux du moments.</p>
        <a href="boutique.php" class="banniere_btn">Voir la boutique</a>
    </div>
  </section>

<section class="produits">
  <div class="produits-header">
    <h2 class="produits-titre">Produits phares</h2>
    <a href="boutique.php">Voir tout</a>
  </div>
  <div class="grille">
    <?php 
    
    foreach ($produits as $produit) : ?>
      <div class="carte">
        <div class="carte-img">
          <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['name']; ?>">
          <?php if ($produit['promo']) : ?>
            <span class="promo">Promo</span>
          <?php endif; ?>
        </div>
        <div class="carte-info">
          <h3 class="carte-nom"><?php echo $produit['name']; ?></h3>
          <p class="carte-prix"><?php echo $produit['price']; ?> €</p>
          <a href="#" class="carte-btn">Acheter</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<footer class="footer">
  <p>© 2025 RetroShop - tout droit reserver</p>
  <nav>
    <a href="index.php">Acceuil</a>
    <a href="boutique.php">Boutique</a>
    <a href="">Contact</a>
  </nav>
</footer>

</body>
</html>