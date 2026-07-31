<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Displays detailed information for a single product and handles the order form submission.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php'; 
require_once __DIR__ . '/includes/auth.php'; // Required to check the logged-in user

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$message = '';
$user = current_user();

// Handle the order submission when the user clicks the button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (!$user) {
        // Double-check authentication; redirect to login if the session expired
        header('Location: login.php');
        exit;
    }

    // Generate a secure, unique order reference (e.g., ORD-A1B2C3D4)
    $orderRef = 'ORD-' . strtoupper(substr(md5((string)time() . $user['id'] . $id), 0, 8));

    // Insert the new order into the database
    $stmt = db()->prepare("INSERT INTO orders (order_ref, user_id, status) VALUES (:ref, :uid, 'processing')");
    $success = $stmt->execute([
        ':ref' => $orderRef,
        ':uid' => $user['id']
    ]);

    if ($success) {
        $message = "Order placed successfully! Your reference number is: " . $orderRef;
    } else {
        $message = "Failed to place order. Please try again.";
    }
}

$pageTitle = 'Product Details | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';

// Fetch the single product directly from the database using a prepared statement
$stmt = db()->prepare("SELECT id, sku, category, name, compatibility, image_path FROM products WHERE id = :id LIMIT 1");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();
?>
<main>
  <section class="panel">
    
    <!-- Display the success or error message after ordering -->
    <?php if ($message): ?>
        <p style="padding: 10px; background-color: #d1e7dd; color: #0f5132; border-radius: 4px;">
            <strong><?= htmlspecialchars($message) ?></strong>
        </p>
    <?php endif; ?>

    <?php if (!$product): ?>
      <h2>Product not found</h2>
    <?php else: ?>
      <h2><?= htmlspecialchars((string)($product['name'] ?? '')) ?></h2>
      <img src="<?= htmlspecialchars((string)($product['image_path'] ?? '')) ?>" alt="<?= htmlspecialchars((string)($product['name'] ?? '')) ?>" />
      
      <p><strong>SKU:</strong> <?= htmlspecialchars((string)($product['sku'] ?? '')) ?></p>
      <p><strong>Category:</strong> <?= htmlspecialchars((string)($product['category'] ?? '')) ?></p>
      <p><strong>Compatibility:</strong> <?= htmlspecialchars((string)($product['compatibility'] ?? '')) ?></p>
      
      <p><a href="help-fitment.html">Fitment help for this product</a></p>
      
      <hr style="margin: 20px 0;" />
      
      <!-- Order Button Logic -->
      <?php if ($user): ?>
          <form method="post" action="">
              <button type="submit" name="place_order" style="padding: 10px 20px; font-size: 1.1em; cursor: pointer;">
                  Order this Part
              </button>
          </form>
      <?php else: ?>
          <p><em>You must be <a href="login.php">logged in</a> to order this part.</em></p>
      <?php endif; ?>
      
      <hr style="margin: 20px 0;" />

      <label for="rating">Rate this product:</label>
      <select id="rating" aria-label="Rate this product">
        <option>5 - Excellent</option>
        <option>4 - Good</option>
        <option>3 - Average</option>
        <option>2 - Fair</option>
        <option>1 - Poor</option>
      </select>
    <?php endif; ?>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>