<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>

    <link rel="stylesheet" href="../public/assets/css/admin.css">
</head>

<body>

    <div class="container">

        <aside class="sidebar">

            <h2>Admin</h2>

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

            <table>

                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td> </td>
                        <td>PlayStation 5</td>
                        <td>499€</td>
                        <td>12</td>

                        <td class="actions">
                            <button class="edit-btn">Modifier</button>
                            <button class="delete-btn">Supprimer</button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </main>

    </div>

</body>

</html>