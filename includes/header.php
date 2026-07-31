<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Global HTML header, main navigation, and theme initialization.
 */
require_once __DIR__ . '/auth.php';
global $APP_NAME;
$pageTitle = $pageTitle ?? $APP_NAME;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Aftermarket parts catalog for 2008 Honda Civic EX-L 2dr Coupe." />
  <meta name="keywords" content="Honda Civic, aftermarket parts, wheels, aero, maintenance, interior" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="icon" type="image/svg+xml" href="assets/favicon.svg" />
  <link rel="stylesheet" href="style.css" />
</head>
<body class="light-theme">
  <header class="site-header">
    <div>
      <h1><?= htmlspecialchars($APP_NAME) ?></h1>
      <p class="subtitle">2008 Honda Civic EX-L 2dr Coupe</p>
    </div>
    <div class="theme-box">
      <label for="themeSelect">Theme:</label>
      <select id="themeSelect">
        <option value="light-theme">Light</option>
        <option value="dark-theme">Dark</option>
        <option value="blue-theme">Blue</option>
      </select>
    </div>
  </header>

  <nav class="main-menu" aria-label="Main menu">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="catalog.php">Catalog</a>
    <a href="map.php">Map</a>
    <a href="visualization.php">Data</a>
    <a href="contact.php">Contact</a>
    <a href="converter.php">Currency</a>
    <a href="help-getting-started.html">Help Wiki</a>
    <?php if (current_user()): ?>
      <a href="profile.php">Profile</a>
      <a href="order-history.php">Orders</a>
      <a href="service-request.php">Service</a>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    <?php endif; ?>
    <a href="admin/index.php">Admin</a>
  </nav>

