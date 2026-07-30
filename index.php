<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
$pageTitle = 'Home | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Welcome</h2>
    <p>Browse a dedicated aftermarket catalog for the 2008 Honda Civic EX-L 2dr Coupe with clear options, fitment details, and live utility tools.</p>
  </section>

  <section class="panel">
    <h2>Media</h2>
    <div class="media-grid">
      <video controls preload="metadata">
        <source src="assets/media/video1.MOV" type="video/mp4" />
      </video>
      <video controls preload="metadata">
        <source src="assets/media/video2.MOV" type="video/mp4" />
      </video>
      <video controls preload="metadata">
        <source src="assets/media/video3.MOV" type="video/mp4" />
      </video>
    </div>
  </section>

  <section class="panel">
    <h2>Quick Access</h2>
    <ul>
      <li><a href="catalog.php">Browse products</a></li>
      <li><a href="help-getting-started.html">User help wiki</a></li>
      <li><a href="docs/FRONTEND_GUIDE.md">Front-end documentation</a></li>
      <li><a href="docs/INSTALL.md">Installation documentation</a></li>
    </ul>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

