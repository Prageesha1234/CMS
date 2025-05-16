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
    <title>My Grades - Student Panel - BIXBEE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>My Grades</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="content">
                <div class="grades-summary">
                    <div class="summary-card">
                        <h3>Overall GPA</h3>
                        <div class="gpa">3.75</div>
                        <p>Out of 4.0 scale</p>
                    </div>
                    <div class="summary-card">
                        <h3>Credits Earned</h3>
                        <div class="credits">45</div>
                        <p>Out of 120 required</p>
                    </div>
                    <div class="summary-card">
                        <h3>Completion Rate</h3>
                        <div class="completion">85%</div>
                        <p>Of enrolled courses</p>
                    </div>
                </div>

                <div class="grades-table-container">
                    <h2>Course Grades</h2>
                    <table class="grades-table">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Instructor</th>
                                <th>Assignments</th>
                                <th>Exams</th>
                                <th>Final Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Introduction to Programming</td>
                                <td>Prof. John Smith</td>
                                <td>88%</td>
                                <td>92%</td>
                                <td>90% (A)</td>
                                <td><span class="badge completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Web Development Fundamentals</td>
                                <td>Prof. Sarah Johnson</td>
                                <td>85%</td>
                                <td>78%</td>
                                <td>81% (B)</td>
                                <td><span class="badge in-progress">In Progress</span></td>
                            </tr>
                            <tr>
                                <td>Database Management</td>
                                <td>Prof. Michael Brown</td>
                                <td>92%</td>
                                <td>95%</td>
                                <td>94% (A)</td>
                                <td><span class="badge completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Mobile App Development</td>
                                <td>Prof. Emily Davis</td>
                                <td>76%</td>
                                <td>82%</td>
                                <td>80% (B)</td>
                                <td><span class="badge in-progress">In Progress</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="grade-distribution">
                    <h2>Grade Distribution</h2>
                    <div class="chart-container">
                        <div class="chart-bar" style="height: 80%; background-color: #4e73df;" title="A (90-100%) - 2 courses"></div>
                        <div class="chart-bar" style="height: 60%; background-color: #1cc88a;" title="B (80-89%) - 2 courses"></div>
                        <div class="chart-bar" style="height: 20%; background-color: #f6c23e;" title="C (70-79%) - 0 courses"></div>
                        <div class="chart-bar" style="height: 5%; background-color: #e74a3b;" title="D/F (Below 70%) - 0 courses"></div>
                    </div>
                    <div class="chart-legend">
                        <div><span class="legend-color" style="background-color: #4e73df;"></span> A (90-100%)</div>
                        <div><span class="legend-color" style="background-color: #1cc88a;"></span> B (80-89%)</div>
                        <div><span class="legend-color" style="background-color: #f6c23e;"></span> C (70-79%)</div>
                        <div><span class="legend-color" style="background-color: #e74a3b;"></span> D/F (Below 70%)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>