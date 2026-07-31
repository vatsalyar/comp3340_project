<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Admin interface for user account management and access control (disabling users).
 */
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin();
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)($_POST['user_id'] ?? 0);
    $disable = (int)($_POST['disable'] ?? 0);
    $stmt = $pdo->prepare("UPDATE users SET is_disabled = :disable WHERE id = :id");
    $stmt->execute([':disable' => $disable, ':id' => $userId]);
}

$users = $pdo->query("SELECT id, username, email, role, is_disabled FROM users ORDER BY id ASC")->fetchAll();
?>
<!doctype html>
<html lang="en">
<head><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Admin Users</title><link rel="stylesheet" href="../style.css" /></head>
<body class="light-theme">
<header class="site-header"><h1>Manage Users</h1></header>
<nav class="main-menu"><a href="index.php">Dashboard</a></nav>
<main><section class="panel"><ul><?php foreach ($users as $u): ?><li><?= htmlspecialchars($u['username']) ?> (<?= htmlspecialchars($u['role']) ?>) - <?= (int)$u['is_disabled'] ? 'Disabled' : 'Active' ?>
<form method="post" style="display:inline;">
  <input type="hidden" name="user_id" value="<?= (int)$u['id'] ?>" />
  <input type="hidden" name="disable" value="<?= (int)$u['is_disabled'] ? 0 : 1 ?>" />
  <button type="submit"><?= (int)$u['is_disabled'] ? 'Enable' : 'Disable' ?></button>
</form>
</li><?php endforeach; ?></ul></section></main>
<script src="../script.js"></script>
</body></html>

