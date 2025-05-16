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
    <title>Assignments - Student Panel - BIXBEE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>Assignments</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="content">
                <div class="assignment-tabs">
                    <button class="tab-btn active" onclick="openTab('pending')">Pending</button>
                    <button class="tab-btn" onclick="openTab('submitted')">Submitted</button>
                    <button class="tab-btn" onclick="openTab('graded')">Graded</button>
                </div>

                <div id="pending" class="tab-content active">
                    <div class="assignment-card">
                        <div class="assignment-header">
                            <h3>Programming Assignment 1</h3>
                            <span class="due-date"><i class="fas fa-calendar-alt"></i> Due: May 25, 2023</span>
                        </div>
                        <div class="assignment-details">
                            <p><strong>Course:</strong> Introduction to Programming</p>
                            <p><strong>Description:</strong> Create a Python program that calculates the factorial of a number.</p>
                            <div class="assignment-actions">
                                <a href="#" class="btn">Submit Assignment</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="assignment-card">
                        <div class="assignment-header">
                            <h3>Web Design Project</h3>
                            <span class="due-date"><i class="fas fa-calendar-alt"></i> Due: June 1, 2023</span>
                        </div>
                        <div class="assignment-details">
                            <p><strong>Course:</strong> Web Development Fundamentals</p>
                            <p><strong>Description:</strong> Design a responsive portfolio website using HTML and CSS.</p>
                            <div class="assignment-actions">
                                <a href="#" class="btn">Submit Assignment</a>
                                <a href="#" class="btn secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="submitted" class="tab-content">
                    <div class="assignment-card">
                        <div class="assignment-header">
                            <h3>Database Design Task</h3>
                            <span class="status submitted"><i class="fas fa-check-circle"></i> Submitted</span>
                        </div>
                        <div class="assignment-details">
                            <p><strong>Course:</strong> Database Management</p>
                            <p><strong>Submitted on:</strong> May 15, 2023</p>
                            <div class="assignment-actions">
                                <a href="#" class="btn secondary">View Submission</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="graded" class="tab-content">
                    <div class="assignment-card">
                        <div class="assignment-header">
                            <h3>Programming Basics Quiz</h3>
                            <span class="status graded"><i class="fas fa-star"></i> Graded: 85/100</span>
                        </div>
                        <div class="assignment-details">
                            <p><strong>Course:</strong> Introduction to Programming</p>
                            <p><strong>Feedback:</strong> Excellent work! Just need to handle edge cases better.</p>
                            <div class="assignment-actions">
                                <a href="#" class="btn secondary">View Feedback</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(tabName) {
            // Hide all tab content
            const tabContents = document.getElementsByClassName("tab-content");
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove("active");
            }

            // Remove active class from all buttons
            const tabButtons = document.getElementsByClassName("tab-btn");
            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }

            // Show the current tab and mark button as active
            document.getElementById(tabName).classList.add("active");
            event.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>