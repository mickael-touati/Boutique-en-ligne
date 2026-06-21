<?php

require_once "../../app/views/config/database.php";

$conn = $db->getConnection();

$category = $_GET["category"] ?? "";

$sql = "
SELECT *
FROM article
WHERE category_id = :category
";

$stmt = $conn->prepare($sql);

$stmt->execute([
    "category" => $category
]);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");

echo json_encode($products);