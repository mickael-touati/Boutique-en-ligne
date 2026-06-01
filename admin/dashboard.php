<?php

session_start();

if (!isset($_SESSION["admin"])) {

    header("Location: login.php");

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

    <title>Dashboard</title>

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

            <h1>Dashboard Admin</h1>

            <div class="cards">

                <div class="card">

                    <h3>Produits</h3>

                    <p>Gestion des articles</p>

                </div>

                <div class="card">

                    <h3>Commandes</h3>

                    <p>Gestion commandes</p>

                </div>

                <div class="card">

                    <h3>Clients</h3>

                    <p>Gestion utilisateurs</p>

                </div>

            </div>

        </main>

    </div>

</body>

</html>