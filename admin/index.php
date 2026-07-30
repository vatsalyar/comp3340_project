<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/auth.php';
require_admin();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard | COMP3340 Civic Parts Depot</title>
  <link rel="stylesheet" href="../style.css" />
</head>
<body class="light-theme">
  <header class="site-header"><h1>Admin Dashboard</h1><div class="theme-box"><label for="themeSelect">Theme:</label><select id="themeSelect"><option value="light-theme">Light</option><option value="dark-theme">Dark</option><option value="blue-theme">Blue</option></select></div></header>
  <nav class="main-menu"><a href="../index.php">Site Home</a><a href="products.php">Manage Products</a><a href="users.php">Manage Users</a><a href="monitor.php">System Monitor</a><a href="../help-getting-started.php">Admin Help</a></nav>
  <main><section class="panel"><p>Use this area to manage catalog records and user accounts.</p></section></main>
  <script src="../script.js"></script>
</body>
</html>

