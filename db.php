<?php
// Database configuration
$host = 'db';               // Docker service name for MySQL
$db   = 'studentdb';        // Database name (must match init.sql and docker-compose)
$user = 'student_user';     // MySQL username
$pass = 'student_pass';     // MySQL password
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,         // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES => false,                // Disable emulated prepared statements
];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // If connection fails, show error message
    die("Database connection failed: " . $e->getMessage());
}


