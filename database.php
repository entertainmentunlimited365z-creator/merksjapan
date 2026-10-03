<?php
declare(strict_types=1);

function database(): PDO {
  static $pdo = null;
  if ($pdo instanceof PDO) return $pdo;

  $directory = __DIR__ . '/app_data';
  if (!is_dir($directory) && !mkdir($directory, 0700, true) && !is_dir($directory)) {
    throw new RuntimeException('Unable to create the application data directory.');
  }

  $pdo = new PDO('sqlite:' . $directory . '/merks.sqlite');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
  )');
  return $pdo;
}
