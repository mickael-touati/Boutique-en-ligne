<?php

require_once "../../app/views/config/database.php";

$conn = $db->getConnection();

$sql = "SELECT * FROM article";

$stmt = $conn->prepare($sql);

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");

echo json_encode($products);