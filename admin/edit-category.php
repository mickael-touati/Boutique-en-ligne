<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../app/views/config/database.php";

$conn = $db->getConnection();

$id = $_GET["id"];

$sql = "SELECT * FROM category WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->bindParam(":id", $id);

$stmt->execute();

$category = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $sql = "UPDATE category SET name = :name WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":name", $name);

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    header("Location: categories.php");

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

    <title>Modifier catégorie</title>

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

        <h1>Modifier une catégorie</h1>

        <form method="POST">

            <div class="form-group">

                <label>Nom</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo $category["name"]; ?>"
                    required
                >

            </div>

            <button class="btn" type="submit">

                Enregistrer

            </button>

        </form>

    </main>

</div>

</body>

</html>