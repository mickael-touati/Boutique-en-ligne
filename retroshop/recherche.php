<?php
require_once __DIR__ . '/../app/views/config/database.php';

$db = new Database();
$pdo = $db->getConnection();

$q = $_GET['q'];

$stmt = $pdo->prepare("SELECT id, name, price, image FROM article WHERE name LIKE ?");
$stmt->execute(['%' . $q . '%']);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($produits);