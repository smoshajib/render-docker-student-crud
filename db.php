<?php
$databaseUrl = getenv("DATABASE_URL");

if (!$databaseUrl) {
    die("DATABASE_URL environment variable not set");
}

// Parse the URL
$url = parse_url($databaseUrl);
$host = $url["host"];
$port = $url["port"] ?? 5432; // default port
$user = $url["user"];
$pass = $url["pass"];
$db   = ltrim($url["path"], '/');

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


