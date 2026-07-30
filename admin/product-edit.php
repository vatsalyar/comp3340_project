<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $stmt = $pdo->prepare("UPDATE products SET name = :name, category = :category WHERE id = :id");
    $stmt->execute([':name' => $name, ':category' => $category, ':id' => $id]);
    header('Location: products.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, sku, name, category FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
<head><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Edit Product</title><link rel="stylesheet" href="../style.css" /></head>
<body class="light-theme">
<header class="site-header"><h1>Edit Product</h1></header>
<main><section class="panel">
  <?php if (!$product): ?><p>Product not found.</p><?php else: ?>
  <form method="post">
    <input type="text" value="<?= htmlspecialchars($product['sku']) ?>" disabled />
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required />
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required />
    <button type="submit">Save</button>
  </form>
  <?php endif; ?>
</section></main>
<script src="../script.js"></script>
</body></html>

