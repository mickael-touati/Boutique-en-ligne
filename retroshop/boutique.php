<?php
session_start();
require_once "../app/views/config/database.php";

$pdo = $db->getConnection();

$requeteCategories = $pdo->query("SELECT * FROM category");
$categories = array();

while ($ligne = $requeteCategories->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $ligne;
}

$categorie_id = null;

if (isset($_GET["categorie"])) {
    $categorie_id = $_GET["categorie"];
}

$produits = array();

if ($categorie_id != null) {

    $requeteProduits = $pdo->prepare(
        "SELECT * FROM article WHERE category_id = ?"
    );

    $requeteProduits->execute(array($categorie_id));
} else {
    $requeteProduits = $pdo->query(
        "SELECT * FROM article"
    );
}

while ($ligne = $requeteProduits->fetch(PDO::FETCH_ASSOC)) {
    $produits[] = $ligne;
}
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

<main class="boutique">

  <aside class="filtres">
    <h2 class="filtres-titre">Catégories</h2>
    <ul class="filtres-liste">
      <li><a href="boutique.php" <?php if (!$categorie_id) echo 'class="actif"'; ?>>Tout</a></li>
      <?php foreach ($categories as $cat) : ?>
        <li>
          <a href="boutique.php?categorie=<?php echo $cat['id']; ?>"
            <?php if ($categorie_id == $cat['id']) echo 'class="actif"'; ?>>
            <?php echo $cat['name']; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </aside>

  <div class="boutique-contenu">
    <div class="recherche-wrap">
      <input class="recherche" type="text" id="recherche" placeholder="Rechercher un produit...">
      <div class="suggestions" id="suggestions"></div>
    </div>
    <div class="grille">
      <?php foreach ($produits as $produit) : ?>
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
            <a href="produit.php?id=<?php echo $produit['id']; ?>" class="carte-btn">Voir le produit</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</main>

<footer class="footer">
  <p>© 2025 RetroShop - tout droit reserver</p>
  <nav>
    <a href="index.php">Acceuil</a>
    <a href="boutique.php">Boutique</a>
    <a href="">Contact</a>
  </nav>
</footer>

<script>
const input = document.getElementById('recherche');
const suggestions = document.getElementById('suggestions');

input.addEventListener('input', function() {

    let q = input.value;

    if (q.length < 2) {
        suggestions.style.display = 'none';
        return;
    }

    fetch('recherche.php?q=' + q)
        .then(function(reponse) {
            return reponse.json();
        })
        .then(function(produits) {

            suggestions.innerHTML = '';

            if (produits.length === 0) {
                suggestions.style.display = 'none';
                return;
            }

            for (let i = 0; i < produits.length; i++) {

                let produit = produits[i];

                let lien = document.createElement('a');

                lien.href = 'produit.php?id=' + produit.id;
                lien.className = 'suggestion-item';
                lien.innerHTML = produit.name + ' — ' + produit.price + ' €';

                suggestions.appendChild(lien);
            }

            suggestions.style.display = 'block';
        });
});
</script>

</body>
</html>