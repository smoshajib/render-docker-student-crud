<?php
include __DIR__ . '/db.php';

// Validate ID from query parameter
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirect back to index
header("Location: index.php");
exit();
