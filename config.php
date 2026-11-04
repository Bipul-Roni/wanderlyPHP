<?php
declare(strict_types=1);
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'travel_booking');
define('DB_USER', 'root');
define('DB_PASS', '');

function db(): PDO {
    static $pdo = null;
    if (!$pdo) {
        $pdo = new PDO(
            'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
            DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    }
    return $pdo;
}
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function is_admin(): bool { return !empty($_SESSION['admin_id']); }
function require_admin(): void {
    if (!is_admin()) { header('Location: admin-login.php'); exit; }
}
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function verify_csrf(): void {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(403); exit('Invalid CSRF token.');
    }
}
