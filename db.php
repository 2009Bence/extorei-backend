<?php
declare(strict_types=1);

function db(): PDO {
  $host = $_ENV['MYSQLHOST'] ?? getenv('MYSQLHOST');
  $port = $_ENV['MYSQLPORT'] ?? getenv('MYSQLPORT');
  $db   = $_ENV['MYSQLDATABASE'] ?? getenv('MYSQLDATABASE');
  $user = $_ENV['MYSQLUSER'] ?? getenv('MYSQLUSER');
  $pass = $_ENV['MYSQLPASSWORD'] ?? getenv('MYSQLPASSWORD');

  if (!$host || !$port || !$db || !$user) {
    throw new RuntimeException("Missing MySQL env vars");
  }

  $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
  return new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
}
