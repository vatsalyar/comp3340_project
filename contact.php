<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
$pageTitle = 'Contact | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Contact Us</h2>
    <p><a href="help-ordering.html">Help with ordering form</a></p>
    <form id="contactForm">
      <input type="text" name="name" placeholder="Your name" required />
      <input type="email" name="email" placeholder="Your email" required />
      <textarea name="message" rows="4" placeholder="Your message" required></textarea>
      <button type="submit">Send</button>
    </form>
    <p id="contactResult"></p>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

