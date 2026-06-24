<?php
session_start();
require_once __DIR__ . '/../app/views/config/database.php';

$pdo = $db->getConnection();

$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("DELETE FROM panier WHERE user_id = ? AND article_id = ?");
$stmt->execute([$user_id, $id]);

header('Location: panier.php');
exit();
?>