<?php

session_start();

if (!isset($_SESSION["admin"])) {

    header("Location: login.php");

    exit;
}

require_once "../app/views/config/database.php";

$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $category_id = $_POST["category_id"];
    $promo = $_POST["promo"];

    $sql = "
    INSERT INTO article(
        name,
        price,
        stock,
        description,
        image,
        category_id,
        promo
    )

    VALUES(
        :name,
        :price,
        :stock,
        :description,
        :image,
        :category_id,
        :promo
    )
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":stock", $stock);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":category_id", $category_id);
    $stmt->bindParam(":promo", $promo);

    $stmt->execute();
}

if (isset($_GET["delete"])) {

    $id = $_GET["delete"];

    $sql = "DELETE FROM article WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $id);

    $stmt->execute();
}

$sql = "
SELECT article.*, category.name AS category_name
FROM article
LEFT JOIN category
ON article.category_id = category.id
";

$stmt = $conn->prepare($sql);

$stmt->execute();

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Produits</title>

    <link
        rel="stylesheet"
        href="../public/assets/css/admin.css"
    >

</head>

<body>

    <div class="container">

        <aside class="sidebar">

            <h2>RShop Admin</h2>

            <nav>

                <ul>

                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="products.php">Produits</a></li>
                    <li><a href="categories.php">Catégories</a></li>
                    <li><a href="stocks.php">Stocks</a></li>
                    <li><a href="orders.php">Commandes</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>

                </ul>

            </nav>

        </aside>

        <main class="content">

            <h1>Gestion des produits</h1>

            <section class="form-box">

                <h2>Ajouter un produit</h2>

                <form method="POST">

                    <div class="form-group">

                        <label for="name">Nom</label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="price">Prix</label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="stock">Stock</label>

                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="description">Description</label>

                        <textarea
                            name="description"
                            id="description"
                        ></textarea>

                    </div>

                    <div class="form-group">

                        <label for="image">Image</label>

                        <input
                            type="text"
                            name="image"
                            id="image"
                            placeholder="img/image.png"
                        >

                    </div>

                    <div class="form-group">

                        <label for="category_id">Catégorie</label>

                        <select
                            name="category_id"
                            id="category_id"
                        >

                            <option value="1">Consoles</option>
                            <option value="2">Jeux</option>
                            <option value="3">Accessoires</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="promo">Promo</label>

                        <select
                            name="promo"
                            id="promo"
                        >

                            <option value="0">Non</option>
                            <option value="1">Oui</option>

                        </select>

                    </div>

                    <button class="btn" type="submit">

                        Ajouter

                    </button>

                </form>

            </section>

            <div class="search-box">

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Rechercher un produit..."
                >

            </div>

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Catégorie</th>
                        <th>Promo</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody id="productsTable">

                    <?php foreach ($articles as $article) : ?>

                        <tr>

                            <td><?php echo $article["id"]; ?></td>

                            <td>

                                <img
                                    class="product-img"
                                    src="../<?php echo $article["image"]; ?>"
                                    alt="produit"
                                >

                            </td>

                            <td><?php echo $article["name"]; ?></td>

                            <td><?php echo $article["price"]; ?>€</td>

                            <td><?php echo $article["stock"]; ?></td>

                            <td><?php echo $article["category_name"]; ?></td>

                            <td>

                                <?php

                                if ($article["promo"] == 1) {

                                    echo "Oui";

                                } else {

                                    echo "Non";
                                }

                                ?>

                            </td>

                            <td class="actions">

                                <a href="edit-product.php?id=<?php echo $article["id"]; ?>">

                                    <button class="edit-btn">
                                        Modifier
                                    </button>

                                </a>

                                <a
                                    class="delete-link"
                                    href="products.php?delete=<?php echo $article["id"]; ?>"
                                >

                                    <button class="delete-btn">
                                        Supprimer
                                    </button>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </main>

    </div>

    <script src="../public/assets/js/admin.js"></script>
    <script src="../public/assets/js/admin-search.js"></script>

</body>

</html>