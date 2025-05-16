<?php
session_start();
// Verify admin role
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    /* Base Dashboard Styles */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        background-color: #f8f9fc;
    }

    .main-content {
        flex: 1;
        margin-left: 250px;
        padding: 20px;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    header h1 {
        font-size: 1.8rem;
        color: #2c3e50;
        margin: 0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Dashboard Cards */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        display: flex;
        overflow: hidden;
    }

    .card-icon {
        width: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .card-info {
        padding: 20px;
        flex: 1;
    }

    .card-info h3 {
        margin: 0 0 5px 0;
        font-size: 1rem;
        color: #666;
    }

    .card-info p {
        margin: 0;
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
    }

    /* Tables */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #555;
    }

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status.completed {
        background-color: #d4edda;
        color: #155724;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
        }
    }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Include the sidebar -->
        <?php include 'admin_sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Admin Dashboard</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="dashboard-cards">
                <!-- Quick Stats Cards -->
                <div class="card">
                    <div class="card-icon" style="background-color: #4e73df;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-info">
                        <h3>Total Users</h3>
                        <p>1,254</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #1cc88a;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-info">
                        <h3>Active Courses</h3>
                        <p>42</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #36b9cc;">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-info">
                        <h3>Support Tickets</h3>
                        <p>15</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #f6c23e;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-info">
                        <h3>Monthly Revenue</h3>
                        <p>$8,250</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Created new course</td>
                            <td>10 mins ago</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Updated profile</td>
                            <td>25 mins ago</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>System</td>
                            <td>Database backup</td>
                            <td>1 hour ago</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>