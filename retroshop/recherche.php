<?php
require_once __DIR__ . '/../app/views/config/database.php';

$pdo = $db->getConnection();

$q = $_GET['q'];
$recherche = '%' . $q . '%';

$stmt = $pdo->prepare("SELECT id, name, price, image FROM article WHERE name LIKE ?");
$stmt->execute([$recherche]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($produits);