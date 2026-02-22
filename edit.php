<?php
include __DIR__ . '/db.php';

// Get ID from query parameter, validate as integer
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

// Fetch student record
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    echo "Student not found!";
    exit();
}

// Handle POST update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone'] ?? '');

    $stmt = $pdo->prepare("UPDATE students SET name=?, email=?, phone=? WHERE id=?");
    $stmt->execute([$name, $email, $phone, $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="POST">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required><br><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required><br><br>
        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($student['phone'] ?? ''); ?>"><br><br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="index.php">Back to Student List</a>
</body>
</html>
