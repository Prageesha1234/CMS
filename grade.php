<?php
session_start();
require_once 'instructor_sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Assignments - BIXBEE</title>
    <link rel="stylesheet" href="instructor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'instructor_sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>Grade Assignments</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="grading-interface">
                <!-- Grading interface content goes here -->
            </div>
        </div>
    </div>
</body>
</html>