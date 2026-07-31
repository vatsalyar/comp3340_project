<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: System monitoring page tracking backend services and database uptime.
 */
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_admin();

/**
 * Simple status check helper.
 */
function endpoint_ok(string $url): bool
{
    $ctx = stream_context_create(['http' => ['timeout' => 3]]);
    $response = @file_get_contents($url, false, $ctx);
    return $response !== false;
}

$dbStatus = 'online';
try {
    db()->query('SELECT 1');
} catch (Throwable $e) {
    $dbStatus = 'offline';
}

$currencyApi = endpoint_ok('https://open.er-api.com/v6/latest/USD') ? 'online' : 'offline';
$weatherApi = endpoint_ok('https://api.open-meteo.com/v1/forecast?latitude=42.3149&longitude=-83.0364&current=temperature_2m') ? 'online' : 'offline';
?>
<!doctype html>
<html lang="en">
<head><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>System Monitor</title><link rel="stylesheet" href="../style.css" /></head>
<body class="light-theme">
<header class="site-header"><h1>System Monitor</h1></header>
<nav class="main-menu"><a href="index.php">Dashboard</a></nav>
<main><section class="panel"><ul>
  <li>Database: <strong><?= htmlspecialchars($dbStatus) ?></strong></li>
  <li>Currency API: <strong><?= htmlspecialchars($currencyApi) ?></strong></li>
  <li>Weather API: <strong><?= htmlspecialchars($weatherApi) ?></strong></li>
</ul></section></main>
<script src="../script.js"></script>
</body></html>

