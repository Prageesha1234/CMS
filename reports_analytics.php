<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics - BIXBEE Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <?php include 'admin_sidebar.php'; ?>
        
        <div class="main-content">
            <header>
                <h1>Reports & Analytics</h1>
                <div class="user-info">
                    <span><?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="analytics-period">
                <select>
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                    <option>Last 90 Days</option>
                    <option selected>This Year</option>
                    <option>All Time</option>
                </select>
            </div>

            <div class="analytics-grid">
                <div class="analytics-card">
                    <h3>User Growth</h3>
                    <canvas id="userGrowthChart"></canvas>
                </div>
                
                <div class="analytics-card">
                    <h3>Course Enrollment</h3>
                    <canvas id="enrollmentChart"></canvas>
                </div>
                
                <div class="analytics-card">
                    <h3>Revenue</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
                
                <div class="analytics-card">
                    <h3>Top Courses</h3>
                    <div class="top-courses-list">
                        <div class="course-item">
                            <span>1.</span>
                            <span>Advanced Web Development</span>
                            <span>245 students</span>
                        </div>
                        <div class="course-item">
                            <span>2.</span>
                            <span>Data Science Fundamentals</span>
                            <span>198 students</span>
                        </div>
                        <div class="course-item">
                            <span>3.</span>
                            <span>Mobile App Design</span>
                            <span>156 students</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="export-section">
                <button class="btn btn-primary"><i class="fas fa-file-export"></i> Export as PDF</button>
                <button class="btn btn-secondary"><i class="fas fa-file-csv"></i> Export as CSV</button>
            </div>
        </div>
    </div>

    <script>
        // User Growth Chart
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(userGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'New Users',
                    data: [120, 190, 170, 220, 280, 310, 350],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Enrollment Chart
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'bar',
            data: {
                labels: ['Web Dev', 'Data Sci', 'Design', 'Business', 'Marketing'],
                datasets: [{
                    label: 'Enrollments',
                    data: [350, 280, 200, 180, 150],
                    backgroundColor: '#1cc88a'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['Courses', 'Subscriptions', 'Certifications'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>