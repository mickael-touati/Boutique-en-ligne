<?php

require_once "../../app/views/config/database.php";

$conn = $db->getConnection();

$search = $_GET["search"] ?? "";

$sql = "
SELECT *
FROM article
WHERE name LIKE :search
";

$stmt = $conn->prepare($sql);

$stmt->execute([
    "search" => "%" . $search . "%"
]);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");

echo json_encode($products);