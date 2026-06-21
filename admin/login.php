<?php

session_start();

require_once "../app/views/config/database.php";

$conn = $db->getConnection();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE email = :email";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {

        if (password_verify($password, $admin["password"])) {

            $_SESSION["admin"] = $admin["email"];

            header("Location: dashboard.php");

            exit;

        } else {

            $error = "Mot de passe incorrect";
        }

    } else {

        $error = "Admin introuvable";
    }
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

    <title>Connexion Admin</title>

    <link
        rel="stylesheet"
        href="../public/assets/css/admin.css"
    >

</head>

<body>

    <div class="login-box">

        <h1>Connexion Admin</h1>

        <?php if ($error != "") : ?>

            <p class="error">

                <?php echo $error; ?>

            </p>

        <?php endif; ?>

        <form method="POST">

            <div class="form-group">

                <label for="email">Email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                >

            </div>

            <div class="form-group">

                <label for="password">Mot de passe</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                >

            </div>

            <button class="btn" type="submit">

                Connexion

            </button>

        </form>

    </div>

</body>

</html>