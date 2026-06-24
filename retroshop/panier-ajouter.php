<?php
session_start();
require_once __DIR__ . '/../app/views/config/database.php';

$pdo = $db->getConnection();

$id = $_GET['id'];
$quantite = $_GET['quantite'];

if (!isset($_SESSION['user'])) {
    header('Location: ../app/views/auth/login.php');
    exit();
}

$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT stock FROM article WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);
$stock = $produit['stock'];

$stmt = $pdo->prepare("SELECT * FROM panier WHERE user_id = ? AND article_id = ?");
$stmt->execute([$user_id, $id]);
$existant = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existant) {
    $nouvelle_quantite = $existant['quantite'] + $quantite;

    if ($nouvelle_quantite > $stock) {
        $nouvelle_quantite = $stock;
    }

    $stmt = $pdo->prepare("UPDATE panier SET quantite = ? WHERE user_id = ? AND article_id = ?");
    $stmt->execute([$nouvelle_quantite, $user_id, $id]);
} else {
    
    if ($quantite > $stock) {
        $quantite = $stock;
    }

    $stmt = $pdo->prepare("INSERT INTO panier (user_id, article_id, quantite) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $id, $quantite]);
}

header('Location: panier.php');
exit();
?>