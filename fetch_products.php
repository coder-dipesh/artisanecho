<?php
require 'db.php';

$type = $_GET['type'] ?? 'all';
$price = $_GET['price'] ?? 'any';
$sort = $_GET['sort'] ?? 'newest';

$query = "SELECT * FROM products WHERE 1=1";

if ($type !== 'all') {
    $query .= " AND category = :type";
}

if ($price !== 'any') {
    [$min, $max] = explode("-", $price);
    $query .= " AND price BETWEEN :min AND :max";
}

switch ($sort) {
    case 'price_asc':
        $query .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY price DESC";
        break;
    case 'name_asc':
        $query .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $query .= " ORDER BY name DESC";
        break;
    default:
        $query .= " ORDER BY created_at DESC";
}

$stmt = $pdo->prepare($query);

if ($type !== 'all') $stmt->bindValue(':type', $type);
if ($price !== 'any') {
    $stmt->bindValue(':min', $min, PDO::PARAM_INT);
    $stmt->bindValue(':max', $max, PDO::PARAM_INT);
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($products) {
    foreach ($products as $product) {
        echo "<li class='card'>";
        echo "  <figure class='card-media'>";
        if (!empty($product['image_url'])) {
            echo "    <img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['name']) . "' />";
        } else {
            echo "    <img src='https://placehold.co/400' alt='No image available' />";
        }
        echo "    <figcaption class='card-title'>" . htmlspecialchars($product['name']) . "</figcaption>";
        echo "  </figure>";
        echo "  <p class='body-text'>" . htmlspecialchars($product['description']) . "</p>";
        echo "  <p class='price'>$" . number_format($product['price'], 2) . "</p>";

        if ($product['stock'] > 0) {
            echo "  <button class='btn btn-primary'>Add to Cart</button>";
        } else {
            echo "  <p class='out-of-stock'>Out of Stock</p>";
        }
        echo "</li>";
    }
} else {
    echo "<p>No products found.</p>";
}