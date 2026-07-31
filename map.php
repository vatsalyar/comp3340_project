<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Renders an interactive map indicating the store/distribution location.
 */
require_once __DIR__ . '/config.php';
$pageTitle = 'Interactive Map | COMP3340 Civic Parts Depot';
require_once __DIR__ . '/includes/header.php';
?>
<main>
  <section class="panel">
    <h2>Pickup and Partner Garages</h2>
    <p><a href="help-ordering.html">Help for pickup and service locations</a></p>
    <div id="map" style="height:380px;border:1px solid var(--border);border-radius:10px;"></div>
  </section>
</main>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  // Interactive map using Leaflet and OpenStreetMap tiles.
  const map = L.map('map').setView([42.3149, -83.0364], 11);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  L.marker([42.3149, -83.0364]).addTo(map).bindPopup('Windsor Pickup Hub');
  L.marker([42.2951, -83.0101]).addTo(map).bindPopup('Partner Garage A');
  L.marker([42.3282, -83.0709]).addTo(map).bindPopup('Partner Garage B');
</script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

