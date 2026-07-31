<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Handles new user registration, validation, and password hashing.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Register | COMP3340 Civic Parts Depot';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username && $email && $password) {
        $sql = "INSERT INTO users (username, email, password_hash, role, is_disabled) VALUES (:username, :email, :hash, 'customer', 0)";
        $stmt = db()->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':hash' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        $message = 'Registration complete. You can now log in.';
    } else {
        $message = 'Please complete all fields.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Create Account</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Register</button>
    </form>
    <p><?= htmlspecialchars($message) ?></p>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

