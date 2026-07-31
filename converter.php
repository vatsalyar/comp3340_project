<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Utility page for real-time currency conversion.
 */
require_once __DIR__ . '/config.php';
$pageTitle = 'Currency Converter | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>USD to CAD Converter</h2>
    <p><a href="help-theme.html">Theme and tools help</a></p>
    <form id="currencyForm">
      <input type="number" id="usdAmount" min="0" step="0.01" placeholder="USD amount" required />
      <button type="submit">Convert</button>
    </form>
    <p id="currencyResult"></p>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

