<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Handles user authentication, password verification, and session creation.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Login | COMP3340 Civic Parts Depot';

$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = db()->prepare("SELECT id, username, email, password_hash, role, is_disabled FROM users WHERE username = :username LIMIT 1");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        
        if ((int)$user['is_disabled'] === 1) {
            $message = 'Your account has been disabled by an administrator.';
        } else {
            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            header('Location: profile.php');
            exit;
        }
        
    } else {
        // Only override the message if it wasn't already set to the disabled warning
        if (empty($message)) {
            $message = 'Invalid credentials.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Login</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p><?= htmlspecialchars($message) ?></p>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>