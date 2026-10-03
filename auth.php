<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
  session_start();
}

function csrf_token(): string {
  if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  return $_SESSION['csrf_token'];
}

function verify_csrf(): void {
  if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
    http_response_code(400);
    exit('フォームの有効期限が切れました。ページを戻って、もう一度お試しください。');
  }
}

function current_user(): ?array {
  return $_SESSION['user'] ?? null;
}

function require_guest(): void {
  if (current_user()) { header('Location: index.php'); exit; }
}

function redirect_with_message(string $location, string $message): void {
  $_SESSION['flash_message'] = $message;
  header('Location: ' . $location);
  exit;
}

function flash_message(): ?string {
  $message = $_SESSION['flash_message'] ?? null;
  unset($_SESSION['flash_message']);
  return $message;
}
