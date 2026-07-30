<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php'; // Added DB connection

$pageTitle = 'Catalog Data Visualization | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';

// Fetch the category counts directly from the MySQL database
$stmt = db()->query("SELECT category, COUNT(*) as count FROM products GROUP BY category");
$categoryData = $stmt->fetchAll();
?>
<main>
  <section class="panel">
    <h2>Products by Category (SVG Graph)</h2>
    <svg viewBox="0 0 700 260" width="100%" role="img" aria-label="Bar chart of products by category">
      <rect x="0" y="0" width="700" height="260" fill="transparent"></rect>
      <?php
      $x = 60;
      foreach ($categoryData as $row):
          $cat = $row['category'];
          $count = (int)$row['count'];
          
          // Calculate height and Y position based on the count
          $h = $count * 30;
          $y = 210 - $h;
      ?>
      <rect x="<?= $x ?>" y="<?= $y ?>" width="100" height="<?= $h ?>" fill="#0ea5e9"></rect>
      <text x="<?= $x + 50 ?>" y="230" text-anchor="middle" font-size="12"><?= htmlspecialchars($cat) ?></text>
      <text x="<?= $x + 50 ?>" y="<?= $y - 5 ?>" text-anchor="middle" font-size="12"><?= $count ?></text>
      <?php $x += 150; endforeach; ?>
    </svg>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>