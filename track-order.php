<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php'; // Added DB connection

$pageTitle = 'Track Order | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';

$orderStatus = null;
$orderRef = trim($_GET['order_ref'] ?? '');

// If a reference number was submitted, query the orders table
if ($orderRef !== '') {
    $stmt = db()->prepare("SELECT status FROM orders WHERE order_ref = :ref LIMIT 1");
    $stmt->execute([':ref' => $orderRef]);
    $order = $stmt->fetch();
    
    if ($order) {
        $orderStatus = $order['status'];
    } else {
        $orderStatus = 'Not Found';
    }
}
?>
<main>
  <section class="panel">
    <h2>Track Order</h2>
    <form method="get">
      <!-- Added value attribute so the input remembers what the user typed -->
      <input type="text" name="order_ref" placeholder="Order Reference (e.g. ORD-1001)" required value="<?= htmlspecialchars($orderRef) ?>" />
      <button type="submit">Track</button>
    </form>
    
    <?php if ($orderRef !== ''): ?>
        <?php if ($orderStatus === 'Not Found'): ?>
            <p>Order <strong><?= htmlspecialchars($orderRef) ?></strong> could not be found. Please double-check your reference number.</p>
        <?php else: ?>
            <p>Order <?= htmlspecialchars($orderRef) ?> is currently: <strong><?= htmlspecialchars($orderStatus) ?></strong>.</p>
        <?php endif; ?>
    <?php endif; ?>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>