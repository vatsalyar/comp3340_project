<?php
declare(strict_types=1);

/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Destroys the active user session and redirects to the homepage.
 */
require_once __DIR__ . '/includes/auth.php';
$_SESSION = [];
session_destroy();
header('Location: index.php');
exit;
