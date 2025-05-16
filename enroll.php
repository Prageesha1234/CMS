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
    <title>Enroll in Courses - Student Panel - BIXBEE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>Enroll in Courses</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="content">
                <div class="enroll-header">
                    <h2>Available Courses</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search courses...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="course-grid">
                    <div class="course-card">
                        <div class="course-thumbnail" style="background-color: #4e73df;"></div>
                        <div class="course-info">
                            <h3>Introduction to Programming</h3>
                            <p class="course-description">Learn the fundamentals of programming with Python.</p>
                            <div class="course-meta">
                                <span><i class="fas fa-book-open"></i> 12 Lessons</span>
                                <span><i class="fas fa-clock"></i> 8 Hours</span>
                                <span><i class="fas fa-user-graduate"></i> Beginner</span>
                            </div>
                            <div class="course-actions">
                                <a href="#" class="btn">Enroll Now</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="course-thumbnail" style="background-color: #1cc88a;"></div>
                        <div class="course-info">
                            <h3>Web Development Fundamentals</h3>
                            <p class="course-description">Build websites with HTML, CSS, and JavaScript.</p>
                            <div class="course-meta">
                                <span><i class="fas fa-book-open"></i> 15 Lessons</span>
                                <span><i class="fas fa-clock"></i> 10 Hours</span>
                                <span><i class="fas fa-user-graduate"></i> Beginner</span>
                            </div>
                            <div class="course-actions">
                                <a href="#" class="btn">Enroll Now</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="course-thumbnail" style="background-color: #f6c23e;"></div>
                        <div class="course-info">
                            <h3>Database Management</h3>
                            <p class="course-description">Master SQL and database design principles.</p>
                            <div class="course-meta">
                                <span><i class="fas fa-book-open"></i> 10 Lessons</span>
                                <span><i class="fas fa-clock"></i> 6 Hours</span>
                                <span><i class="fas fa-user-graduate"></i> Intermediate</span>
                            </div>
                            <div class="course-actions">
                                <a href="#" class="btn">Enroll Now</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="course-thumbnail" style="background-color: #36b9cc;"></div>
                        <div class="course-info">
                            <h3>Mobile App Development</h3>
                            <p class="course-description">Create cross-platform apps with Flutter.</p>
                            <div class="course-meta">
                                <span><i class="fas fa-book-open"></i> 18 Lessons</span>
                                <span><i class="fas fa-clock"></i> 12 Hours</span>
                                <span><i class="fas fa-user-graduate"></i> Intermediate</span>
                            </div>
                            <div class="course-actions">
                                <a href="#" class="btn">Enroll Now</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>