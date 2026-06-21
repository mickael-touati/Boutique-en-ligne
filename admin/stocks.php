<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../app/views/config/database.php";

$conn = $db->getConnection();

$sql = "SELECT * FROM article";

$stmt = $conn->prepare($sql);

$stmt->execute();

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <link rel="stylesheet" href="../public/assets/css/admin.css">
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

        <h1>Gestion des stocks</h1>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Stock</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($articles as $article) : ?>

                    <tr>

                        <td><?php echo $article["id"]; ?></td>

                        <td><?php echo $article["name"]; ?></td>

                        <td><?php echo $article["stock"]; ?></td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </main>

</div>

</body>

</html>