<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>

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

            <h1>Gestion des catégories</h1>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Consoles</td>

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