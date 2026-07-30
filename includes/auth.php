<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Returns current authenticated user or null.
 */
function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

/**
 * Requires authentication for private pages.
 */
function require_login(): void
{
    if (!current_user()) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Requires admin role.
 */
function require_admin(): void
{
    $user = current_user();
    if (!$user || ($user['role'] ?? '') !== 'admin') {
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }
}
