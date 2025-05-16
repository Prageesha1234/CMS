<?php
session_start();
// Verify student role
if ($_SESSION['user_type'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="dashboard-container">
           <?php include 'student_sidebar.php'; ?>
        <!-- Sidebar Navigation -->
        
        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Student Dashboard</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="dashboard-cards">
                <!-- Quick Stats Cards -->
                <div class="card">
                    <div class="card-icon" style="background-color: #4e73df;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-info">
                        <h3>Enrolled Courses</h3>
                        <p>5</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #1cc88a;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="card-info">
                        <h3>Pending Assignments</h3>
                        <p>3</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #36b9cc;">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="card-info">
                        <h3>Questionnaires</h3>
                        <p>2</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #f6c23e;">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-info">
                        <h3>Average Grade</h3>
                        <p>85%</p>
                    </div>
                </div>
            </div>

            <!-- Current Courses Section -->
            <div class="current-courses">
                <h2>My Current Courses</h2>
                <div class="course-grid">
                    <div class="course-card">
                        <div class="course-thumbnail" style="background-color: #4e73df;"></div>
                        <div class="course-info">
                            <h3>Introduction to Programming</h3>
                            <div class="progress-container">
                                <div class="progress-bar" style="width: 65%;"></div>
                                <span>65% Complete</span>
                            </div>
                            <div class="course-actions">
                                <a href="#" class="btn">Continue</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <!-- More course cards... -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
