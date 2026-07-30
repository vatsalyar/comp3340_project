<?php

require_once __DIR__ . '/includes/db.php';

// Fetch all products from the database
$products = db()->query("SELECT * FROM products")->fetchAll();

// Directory to save the HTML files
$outputDir = __DIR__;

foreach ($products as $product) {
    $productId = str_pad($product['id'], 3, '0', STR_PAD_LEFT);
    $fileName = "$outputDir/product-$productId.html";

    // Generate HTML content
    $htmlContent = "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>" . htmlspecialchars($product['name']) . "</title>
    <link rel=\"stylesheet\" href=\"style.css\">
</head>
<body>
    <header class=\"site-header\">
        <h1>" . htmlspecialchars($product['name']) . "</h1>
    </header>
    <main>
        <section class=\"panel\">
            <img src=\"assets/images/" . htmlspecialchars($product['sku']) . ".svg\" alt=\"" . htmlspecialchars($product['name']) . "\">
            <p><strong>SKU:</strong> " . htmlspecialchars($product['sku']) . "</p>
            <p><strong>Category:</strong> " . htmlspecialchars($product['category']) . "</p>
            <p><strong>Compatibility:</strong> " . htmlspecialchars($product['compatibility']) . "</p>
        </section>
    </main>
    <footer class=\"site-footer\">
        <p>&copy; 2026 COMP3340 Civic Parts Depot</p>
    </footer>
</body>
</html>";

    // Save to file
    file_put_contents($fileName, $htmlContent);
}

echo "Product HTML files generated successfully.";
