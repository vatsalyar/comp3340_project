<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Retrieves and displays the dynamically generated product catalog.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';

$pageTitle = 'Catalog | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';

// Dynamically fetch products and join their Standard and Premium prices from the product_options table
$sql = "
    SELECT 
        p.id, 
        p.sku, 
        p.category, 
        p.name, 
        p.compatibility, 
        p.image_path,
        std.price AS standard_price,
        prm.price AS premium_price
    FROM products p
    LEFT JOIN product_options std ON p.id = std.product_id AND std.option_type = 'Standard'
    LEFT JOIN product_options prm ON p.id = prm.product_id AND prm.option_type = 'Premium'
    ORDER BY p.sku ASC
";
$stmt = db()->query($sql);
$products = $stmt->fetchAll();
?>
<main>
  <section class="panel">
    <h2>Catalog</h2>
    <p><a href="help-fitment.html">Need fitment help?</a></p>
    
    <div id="catalog">
      <?php if (count($products) > 0): ?>
          <?php foreach ($products as $p): ?>
              
              <article class="card">
                <img src="<?= htmlspecialchars((string)($p['image_path'] ?? '')) ?>" alt="<?= htmlspecialchars((string)($p['name'] ?? '')) ?>" loading="lazy" />
                
                <h3><?= htmlspecialchars((string)($p['name'] ?? '')) ?></h3>
                <p><strong>SKU:</strong> <?= htmlspecialchars((string)($p['sku'] ?? '')) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars((string)($p['category'] ?? '')) ?></p>
                <p><strong>Fits:</strong> <?= htmlspecialchars((string)($p['compatibility'] ?? '')) ?></p>
                
                <p><strong>Standard:</strong> $<?= number_format((float)($p['standard_price'] ?? 0), 2) ?></p>
                <p><strong>Premium:</strong> $<?= number_format((float)($p['premium_price'] ?? 0), 2) ?></p>
                
                <p><a href="product.php?id=<?= (int)($p['id'] ?? 0) ?>">View details</a> | <a href="help-fitment.html">Fitment help</a></p>
              </article>

          <?php endforeach; ?>
      <?php else: ?>
          <p>No products currently available.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>