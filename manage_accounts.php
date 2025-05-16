<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accounts - BIXBEE Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <?php 
        $sidebar_path = 'admin_sidebar.php';
        if (file_exists($sidebar_path)) {
            include $sidebar_path;
        } else {
            echo '<p style="color: red;">Sidebar file is missing. Please check the file path.</p>';
        }
        ?>
        
        <div class="main-content">
            <header>
                <h1>Manage User Accounts</h1>
                <div class="user-info">
                    <span><?php echo $_SESSION['username']; ?></span>
                    <img src="logos\LOGO.png" alt="User">
                </div>
            </header>

            <div class="content-header">
                <div class="search-filter">
                    <input type="text" placeholder="Search users...">
                    <select>
                        <option>All Users</option>
                        <option>Students</option>
                        <option>Instructors</option>
                        <option>Admins</option>
                    </select>
                    <button class="btn"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <button class="btn btn-primary"><i class="fas fa-plus"></i> Add New User</button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, username, email, user_type FROM users ORDER BY id DESC LIMIT 10";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td><span class="badge '.$row['user_type'].'">'.$row['user_type'].'</span></td>
                                    
                                    <td>
                                        <button class="btn-action edit"><i class="fas fa-edit"></i></button>
                                        <button class="btn-action delete"><i class="fas fa-trash"></i></button>
                                        <button class="btn-action view"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                
                <div class="pagination">
                    <button class="btn"><i class="fas fa-chevron-left"></i></button>
                    <span>Page 1 of 5</span>
                    <button class="btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>