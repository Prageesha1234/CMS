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
    <title>Troubleshooting - BIXBEE Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <?php include 'admin_sidebar.php'; ?>
        
        <div class="main-content">
            <header>
                <h1>System Troubleshooting</h1>
                <div class="user-info">
                    <span><?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="system-status">
                <div class="status-card">
                    <div class="status-icon online">
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="status-info">
                        <h3>Database Server</h3>
                        <p>Status: <span class="online">Online</span></p>
                        <p>Response Time: 42ms</p>
                    </div>
                </div>
                
                <div class="status-card">
                    <div class="status-icon online">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="status-info">
                        <h3>Web Server</h3>
                        <p>Status: <span class="online">Online</span></p>
                        <p>Uptime: 99.98%</p>
                    </div>
                </div>
                
                <div class="status-card">
                    <div class="status-icon warning">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="status-info">
                        <h3>Email Service</h3>
                        <p>Status: <span class="warning">Degraded</span></p>
                        <p>Queue: 12 pending</p>
                    </div>
                </div>
            </div>

            <div class="troubleshooting-tools">
                <h2>Maintenance Tools</h2>
                <div class="tools-grid">
                    <div class="tool-card">
                        <i class="fas fa-database"></i>
                        <h3>Database Backup</h3>
                        <p>Create a complete backup of the system database</p>
                        <button class="btn btn-primary">Run Backup</button>
                    </div>
                    
                    <div class="tool-card">
                        <i class="fas fa-broom"></i>
                        <h3>Cache Clear</h3>
                        <p>Clear all system caches and temporary files</p>
                        <button class="btn btn-primary">Clear Cache</button>
                    </div>
                    
                    <div class="tool-card">
                        <i class="fas fa-search"></i>
                        <h3>System Diagnostics</h3>
                        <p>Run comprehensive system diagnostics</p>
                        <button class="btn btn-primary">Run Diagnostics</button>
                    </div>
                    
                    <div class="tool-card">
                        <i class="fas fa-file-import"></i>
                        <h3>Log Viewer</h3>
                        <p>View and analyze system logs</p>
                        <button class="btn btn-primary">View Logs</button>
                    </div>
                </div>
            </div>

            <div class="recent-issues">
                <h2>Recent System Issues</h2>
                <div class="issues-list">
                    <div class="issue-item">
                        <div class="issue-severity high"></div>
                        <div class="issue-details">
                            <h3>Database Connection Timeout</h3>
                            <p>Occurred 2 hours ago | Resolved</p>
                        </div>
                    </div>
                    <div class="issue-item">
                        <div class="issue-severity medium"></div>
                        <div class="issue-details">
                            <h3>Email Service Delay</h3>
                            <p>Occurred 5 hours ago | Investigating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>