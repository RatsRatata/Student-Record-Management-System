<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $course     = trim($_POST['course'] ?? '');
    $year_level = trim($_POST['year_level'] ?? '');
    $email      = trim($_POST['email'] ?? '');

    if ($student_id && $first_name && $last_name && $course && $year_level && $email) {
        $sql = "INSERT INTO students (student_id, first_name, last_name, course, year_level, email) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$student_id, $first_name, $last_name, $course, $year_level, $email]);
            header("Location: records.php");
            exit;
        } catch (PDOException $e) {
            // Handle duplicate Student ID error cleanly
            if ($e->getCode() == 23000) {
                $error = "Student ID already exists.";
            } else {
                $error = "Database error: " . $e->getMessage();
            }
        }
    } else {
        $error = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create new record</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/dbe048ae79.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="icon">
            <p>R.</p>
            <h1 class="icon-name">RATS</h1>
        </div>
        <h2>Student Records Management System</h2>
    </header>

    <main>
    <div class="form-container">
        <h2>Add New Student</h2>

        <?php if (!empty($error)): ?>
            <p class="error-msg"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="create.php">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" placeholder="2024-01429-MN-0" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" placeholder="Juan" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" placeholder="Dela Cruz" required>

            <label for="course">Course</label>
            <select id="course" name="course">
                <option value="bsit">BSIT</option>
                <option value="bscs">BSCS</option>
            </select>

            <label for="year_level">Year Level</label>
            <input type="text" id="year_level" name="year_level" placeholder="3-1" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com" required>

            <input type="submit">
        </form>
    </div>
    <div class="back-button">
        <button type="button" onclick="history.back()"><i class="fa-solid fa-arrow-left-long" style="color: rgb(0, 24, 62);"></i>Back</button>
    </div>
</main>

    <footer>
        &copy; 2026 RATS
    </footer>
</body>
</html>