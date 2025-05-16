<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("login.php");
    exit();
}
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Support - BIXBEE Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <?php include 'admin_sidebar.php'; ?>
        
        <div class="main-content">
            <header>
                <h1>User Support Tickets</h1>
                <div class="user-info">
                    <span><?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="support-tabs">
                <button class="tab-btn active">All Tickets (24)</button>
                <button class="tab-btn">Open (12)</button>
                <button class="tab-btn">Pending (5)</button>
                <button class="tab-btn">Resolved (7)</button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if the 'support_tickets' table exists
                        $table_check_query = "SHOW TABLES LIKE 'support_tickets'";
                        $table_check_result = $conn->query($table_check_query);

                        if ($table_check_result && $table_check_result->num_rows > 0) {
                            $sql = "SELECT t.id, t.subject, u.username, t.created_at, t.priority, t.status 
                                    FROM support_tickets t
                                    JOIN users u ON t.user_id = u.id
                                    ORDER BY t.created_at DESC LIMIT 10";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                        <td>#'.$row['id'].'</td>
                                        <td>'.$row['subject'].'</td>
                                        <td>'.$row['username'].'</td>
                                        <td>'.date('M d, Y', strtotime($row['created_at'])).'</td>
                                        <td><span class="priority '.strtolower($row['priority']).'">'.$row['priority'].'</span></td>
                                        <td><span class="status '.strtolower($row['status']).'">'.$row['status'].'</span></td>
                                        <td>
                                            <button class="btn-action view"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action reply"><i class="fas fa-reply"></i></button>
                                            <button class="btn-action close"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="7">No tickets found.</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">The support_tickets table does not exist. Please check the database.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                
                <div class="pagination">
                    <button class="btn"><i class="fas fa-chevron-left"></i></button>
                    <span>Page 1 of 3</span>
                    <button class="btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>