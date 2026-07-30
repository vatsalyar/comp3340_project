<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin();
$products = db()->query("SELECT id, sku, name, category FROM products ORDER BY id ASC")->fetchAll();
?>
<!doctype html>
<html lang="en">
<head><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Admin Products</title><link rel="stylesheet" href="../style.css" /></head>
<body class="light-theme">
<header class="site-header"><h1>Manage Products</h1><div class="theme-box"><label for="themeSelect">Theme:</label><select id="themeSelect"><option value="light-theme">Light</option><option value="dark-theme">Dark</option><option value="blue-theme">Blue</option></select></div></header>
<nav class="main-menu"><a href="index.php">Dashboard</a><a href="../catalog.php">Catalog</a></nav>
<main><section class="panel"><p>Edit functionality uses prepared statements in <code>product-edit.php</code>.</p><ul><?php foreach ($products as $p): ?><li><?= htmlspecialchars($p['sku']) ?> - <?= htmlspecialchars($p['name']) ?> (<a href="product-edit.php?id=<?= (int)$p['id'] ?>">Edit</a>)</li><?php endforeach; ?></ul></section></main>
<script src="../script.js"></script>
</body></html>

