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

    $sql = "INSERT INTO category(name) VALUES(:name)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":name", $name);

    $stmt->execute();
}

if (isset($_GET["delete"])) {

    $id = $_GET["delete"];

    $sql = "DELETE FROM category WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $id);

    $stmt->execute();
}

$sql = "SELECT * FROM category";

$stmt = $conn->prepare($sql);

$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Catégories</title>

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

        <h1>Gestion des catégories</h1>

        <section class="form-box">

            <h2>Ajouter une catégorie</h2>

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

                <button class="btn" type="submit">

                    Ajouter

                </button>

            </form>

        </section>

        <table>

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($categories as $category) : ?>

                    <tr>

                        <td><?php echo $category["id"]; ?></td>

                        <td><?php echo $category["name"]; ?></td>

                        <td>

                            <a href="edit-category.php?id=<?php echo $category["id"]; ?>">

                                <button class="edit-btn">

                                    Modifier

                                </button>

                            </a>

                            <a href="categories.php?delete=<?php echo $category["id"]; ?>">

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

</body>

</html>