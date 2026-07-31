<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Form for users to submit and track support tickets.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_login();
$pageTitle = 'Service Request | COMP3340 Civic Parts Depot';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject'] ?? '');
    $details = trim($_POST['details'] ?? '');
    if ($subject && $details) {
        $stmt = db()->prepare("INSERT INTO service_requests (user_id, subject, details, status) VALUES (:uid, :subject, :details, 'open')");
        $stmt->execute([
            ':uid' => current_user()['id'],
            ':subject' => $subject,
            ':details' => $details,
        ]);
        $message = 'Request submitted.';
    } else {
        $message = 'Please complete all fields.';
    }
}
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Submit Service Request</h2>
    <form method="post">
      <input type="text" name="subject" placeholder="Subject" required />
      <textarea name="details" rows="5" placeholder="Describe your request" required></textarea>
      <button type="submit">Submit Request</button>
    </form>
    <p><?= htmlspecialchars($message) ?></p>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

