<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: User dashboard displaying account details and navigation options.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_login();
$pageTitle = 'Profile | COMP3340 Civic Parts Depot';
$user = current_user();
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>User Profile</h2>
    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

