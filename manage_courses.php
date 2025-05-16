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
    <title>Manage Courses - BIXBEE Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <?php include 'admin_sidebar.php'; ?>
        
        <div class="main-content">
            <header>
                <h1>Manage Courses</h1>
                <div class="user-info">
                    <span><?php echo $_SESSION['username']; ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="content-header">
                <div class="search-filter">
                    <input type="text" placeholder="Search courses...">
                    <select>
                        <option>All Categories</option>
                        <option>Programming</option>
                        <option>Design</option>
                        <option>Business</option>
                    </select>
                    <select>
                        <option>All Statuses</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Draft</option>
                    </select>
                    <button class="btn"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <button class="btn btn-primary"><i class="fas fa-plus"></i> Add New Course</button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Title</th>
                            <th>Instructor</th>
                            <th>Category</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if the 'enrolled_students' and 'status' columns exist in the 'courses' table
                        $columns_to_check = ['enrolled_students', 'status'];
                        $existing_columns = [];

                        foreach ($columns_to_check as $column) {
                            $column_check_query = "SHOW COLUMNS FROM courses LIKE '$column'";
                            $column_check_result = $conn->query($column_check_query);
                            if ($column_check_result && $column_check_result->num_rows > 0) {
                                $existing_columns[] = $column;
                            }
                        }

                        $select_columns = "c.id, c.title, u.username as instructor, c.category";
                        if (in_array('enrolled_students', $existing_columns)) {
                            $select_columns .= ", c.enrolled_students";
                        }
                        if (in_array('status', $existing_columns)) {
                            $select_columns .= ", c.status";
                        }

                        $sql = "SELECT $select_columns 
                                FROM courses c
                                JOIN users u ON c.instructor_id = u.id
                                ORDER BY c.id DESC LIMIT 10";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['instructor'].'</td>
                                    <td>'.$row['category'].'</td>';
                                if (in_array('enrolled_students', $existing_columns)) {
                                    echo '<td>'.$row['enrolled_students'].'</td>';
                                } else {
                                    echo '<td>N/A</td>';
                                }
                                if (in_array('status', $existing_columns)) {
                                    echo '<td><span class="status '.$row['status'].'">'.$row['status'].'</span></td>';
                                } else {
                                    echo '<td>N/A</td>';
                                }
                                echo '<td>
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