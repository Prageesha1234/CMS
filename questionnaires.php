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
    <title>Questionnaires - Student Panel - BIXBEE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>Questionnaires</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="content">
                <div class="questionnaire-tabs">
                    <button class="tab-btn active" onclick="openQuestionnaireTab('active')">Active</button>
                    <button class="tab-btn" onclick="openQuestionnaireTab('completed')">Completed</button>
                </div>

                <div id="active" class="tab-content active">
                    <div class="questionnaire-card">
                        <div class="questionnaire-header">
                            <h3>Course Feedback: Introduction to Programming</h3>
                            <span class="due-date"><i class="fas fa-calendar-alt"></i> Closes: June 5, 2023</span>
                        </div>
                        <div class="questionnaire-details">
                            <p>Please provide your feedback about the course content, instructor, and learning experience.</p>
                            <div class="questionnaire-meta">
                                <span><i class="fas fa-question-circle"></i> 15 Questions</span>
                                <span><i class="fas fa-clock"></i> Estimated time: 10 mins</span>
                            </div>
                            <div class="questionnaire-actions">
                                <a href="#" class="btn">Start Questionnaire</a>
                            </div>
                        </div>
                    </div>

                    <div class="questionnaire-card">
                        <div class="questionnaire-header">
                            <h3>Learning Style Assessment</h3>
                            <span class="due-date"><i class="fas fa-calendar-alt"></i> Closes: June 10, 2023</span>
                        </div>
                        <div class="questionnaire-details">
                            <p>Help us understand your learning preferences to improve your experience.</p>
                            <div class="questionnaire-meta">
                                <span><i class="fas fa-question-circle"></i> 20 Questions</span>
                                <span><i class="fas fa-clock"></i> Estimated time: 15 mins</span>
                            </div>
                            <div class="questionnaire-actions">
                                <a href="#" class="btn">Start Questionnaire</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="completed" class="tab-content">
                    <div class="questionnaire-card">
                        <div class="questionnaire-header">
                            <h3>Instructor Evaluation: Prof. John Smith</h3>
                            <span class="status completed"><i class="fas fa-check-circle"></i> Completed</span>
                        </div>
                        <div class="questionnaire-details">
                            <p>Your feedback helps instructors improve their teaching methods.</p>
                            <div class="questionnaire-meta">
                                <span><i class="fas fa-calendar-alt"></i> Completed on: May 10, 2023</span>
                            </div>
                            <div class="questionnaire-actions">
                                <a href="#" class="btn secondary">View Responses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openQuestionnaireTab(tabName) {
            // Hide all tab content
            const tabContents = document.querySelectorAll("#active, #completed");
            tabContents.forEach(tab => tab.classList.remove("active"));

            // Remove active class from all buttons
            const tabButtons = document.querySelectorAll(".questionnaire-tabs .tab-btn");
            tabButtons.forEach(btn => btn.classList.remove("active"));

            // Show the current tab and mark button as active
            document.getElementById(tabName).classList.add("active");
            event.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>