<?php
session_start();
// Verify instructor role
if ($_SESSION['user_type'] !== 'instructor') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - BIXBEE</title>
    <link rel="stylesheet" href="instructor.css">
</head>
<body>
    <div class="dashboard-container">
                <?php include 'instructor_sidebar.php'; ?>
            <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Instructor Dashboard</h1>
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
                        <h3>My Courses</h3>
                        <p>0</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #1cc88a;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-info">
                        <h3>Total Students</h3>
                        <p>0</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #36b9cc;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="card-info">
                        <h3>Pending Assignments</h3>
                        <p>0</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #f6c23e;">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="card-info">
                        <h3>Questionnaires</h3>
                        <p>0</p>
                    </div>
                </div>
            </div>

            
            <div class="recent-courses">
                <h2>My Recent Courses</h2>
                <div class="course-grid">
                    <div class="course-card">
                        <div class="course-thumbnail" style="background-color: #4e73df;"></div>
                        <div class="course-info">
                            <h3>Advanced Web Development</h3>
                            <p>45 Students</p>
                            <div class="course-actions">
                                <a href="#" class="btn">View Course</a>
                                <a href="#" class="btn secondary">Edit</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>