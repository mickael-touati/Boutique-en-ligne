<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../app/views/config/database.php";

$conn = $db->getConnection();

$id = $_GET["id"];

$sql = "SELECT * FROM article WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->bindParam(":id", $id);

$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $promo = $_POST["promo"];

    $sql = "
    UPDATE article
    SET
        name = :name,
        price = :price,
        stock = :stock,
        description = :description,
        image = :image,
        promo = :promo
    WHERE id = :id
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":stock", $stock);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":promo", $promo);
    $stmt->bindParam(":id", $id);

    $stmt->execute();

    header("Location: products.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Modifier produit</title>

    <link
        rel="stylesheet"
        href="../public/assets/css/admin.css"
    >

</head>

<body>

<div class="container">

    <aside class="sidebar">

        <h2>RShop Admin</h2>

        <ul>

            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Produits</a></li>
            <li><a href="categories.php">Catégories</a></li>
            <li><a href="stocks.php">Stocks</a></li>
            <li><a href="orders.php">Commandes</a></li>
            <li><a href="logout.php">Déconnexion</a></li>

        </ul>

    </aside>

    <main class="content">

        <h1>Modifier un produit</h1>

        <form method="POST">

            <div class="form-group">

                <label>Nom</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo $product["name"]; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Prix</label>

                <input
                    type="number"
                    name="price"
                    value="<?php echo $product["price"]; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Stock</label>

                <input
                    type="number"
                    name="stock"
                    value="<?php echo $product["stock"]; ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Description</label>

                <textarea
                    name="description"
                ><?php echo $product["description"]; ?></textarea>

            </div>

            <div class="form-group">

                <label>Image</label>

                <input
                    type="text"
                    name="image"
                    value="<?php echo $product["image"]; ?>"
                >

            </div>

            <div class="form-group">

                <label>Promo</label>

                <select name="promo">

                    <option value="0"
                    <?php if($product["promo"] == 0) echo "selected"; ?>>
                        Non
                    </option>

                    <option value="1"
                    <?php if($product["promo"] == 1) echo "selected"; ?>>
                        Oui
                    </option>

                </select>

            </div>

            <button class="btn" type="submit">

                Enregistrer

            </button>

        </form>

    </main>

</div>

</body>

</html>