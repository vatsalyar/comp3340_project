<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_login();
$pageTitle = 'Order History | COMP3340 Civic Parts Depot';
$stmt = db()->prepare("SELECT id, order_ref, status, created_at FROM orders WHERE user_id = :uid ORDER BY created_at DESC");
$stmt->execute([':uid' => current_user()['id']]);
$orders = $stmt->fetchAll();
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Order History</h2>
    <?php if (!$orders): ?><p>No orders yet.</p><?php endif; ?>
    <ul>
      <?php foreach ($orders as $order): ?>
        <li>#<?= htmlspecialchars($order['order_ref']) ?> - <?= htmlspecialchars($order['status']) ?> (<?= htmlspecialchars($order['created_at']) ?>)</li>
      <?php endforeach; ?>
    </ul>
		<a href="track-order.php">Track an order</a>
  </section>
  <a href="help-ordering.html">Help with ordering</a>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

