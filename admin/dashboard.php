<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../public/assets/css/admin.css">
</head>

<body>

    <div class="container">

        <aside class="sidebar">

            <h2>Admin</h2>

            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Produits</a></li>
                    <li><a href="#">Catégories</a></li>
                    <li><a href="#">Stocks</a></li>
                    <li><a href="#">Commandes</a></li>
                    <li><a href="#">Déconnexion</a></li>
                </ul>
            </nav>

        </aside>

        <main class="content">

            <h1>Gestion des produits</h1>

            <section class="form-box">

                <h2>Ajouter un produit</h2>

                <form>

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" id="name">
                    </div>

                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="number" id="price">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description"></textarea>
                    </div>

                    <button class="btn" type="submit">
                        Ajouter
                    </button>

                </form>

            </section>

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
                        <td> Ajouter </td>
                        <td>PlayStation 5</td>
                        <td>499€</td>
                        <td>12</td>

                        <td class="actions">

                            <button class="edit-btn">
                                Modifier
                            </button>

                            <button class="delete-btn">
                                Supprimer
                            </button>

                        </td>
                    </tr>

                </tbody>

            </table>

        </main>

    </div>

</body>

</html>