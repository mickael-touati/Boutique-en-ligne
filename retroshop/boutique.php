<?php
require_once __DIR__ . '/../app/views/config/database.php';

$db = new Database();
$pdo = $db->getConnection();

$categories = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);

$categorie_id = isset($_GET['categorie']) ? $_GET['categorie'] : null;

if ($categorie_id) {
    $stmt = $pdo->prepare("SELECT * FROM article WHERE category_id = ?");
    $stmt->execute([$categorie_id]);
} else {
    $stmt = $pdo->query("SELECT * FROM article");
}
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
        <a href="">Panier</a>
        <a href="">Connexion</a>
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
var input = document.getElementById('recherche');
var suggestions = document.getElementById('suggestions');

input.addEventListener('input', function() {
  var q = input.value;

  if (q.length < 2) {
    suggestions.style.display = 'none';
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'recherche.php?q=' + q);
  xhr.onload = function() {
    var produits = JSON.parse(xhr.responseText);
    suggestions.innerHTML = '';

    if (produits.length == 0) {
      suggestions.style.display = 'none';
      return;
    }

    for (var i = 0; i < produits.length; i++) {
      var produit = produits[i];
      var a = document.createElement('a');
      a.href = 'produit.php?id=' + produit.id;
      a.className = 'suggestion-item';
      a.innerHTML = '<img src="' + produit.image + '" alt="' + produit.name + '">'
                  + '<span>' + produit.name + '</span>'
                  + '<span>' + produit.price + ' €</span>';
      suggestions.appendChild(a);
    }

    suggestions.style.display = 'block';
  };
  xhr.send();
});
</script>

</body>
</html>