<?php
require_once 'config/db.php';

// Fetch all student records sorted by newest first
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>records</title>
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
        <div class="records-container">
            <div class="records-header">
                <h2>Student Records</h2>
                <a href="create.php" class="button-add"><i class="fa-solid fa-plus"></i> Add Student</a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?= htmlspecialchars($student['student_id']) ?></td>
                                    <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                                    <td><?= htmlspecialchars(strtoupper($student['course'])) ?></td>
                                    <td><?= htmlspecialchars($student['year_level']) ?></td>
                                    <td><?= htmlspecialchars($student['email']) ?></td>
                                    
                                    <!-- Action Buttons -->
                                    <td>
                                        <a href="update.php?id=<?= $student['id'] ?>" class="btn-edit">Edit</a>
                                        <a href="delete.php?id=<?= $student['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="no-records">No student records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="back-button">
            <button type="button" onclick="window.location.href='index.php'">Back</button>
        </div>
    </main>


    <footer>
        &copy; 2026 RATS
    </footer>
</body>
</html>