<?php
// Verify student session
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<div class="sidebar">
    <div class="logo">
        <img src="logos/logo.png" alt="BIXBEE Logo">
        <h2>Student Panel</h2>
    </div>
    <nav>
        <ul>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'student_dashboard.php' ? 'active' : ''; ?>">
                <a href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'my_courses.php' ? 'active' : ''; ?>">
                <a href="my_courses.php"><i class="fas fa-book"></i> My Courses</a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'enroll.php' ? 'active' : ''; ?>">
                <a href="enroll.php"><i class="fas fa-plus-circle"></i> Enroll in Courses</a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'assignments.php' ? 'active' : ''; ?>">
                <a href="assignments.php"><i class="fas fa-tasks"></i> Assignments</a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'questionnaires.php' ? 'active' : ''; ?>">
                <a href="questionnaires.php"><i class="fas fa-question-circle"></i> Questionnaires</a>
            </li>
            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'grades.php' ? 'active' : ''; ?>">
                <a href="grades.php"><i class="fas fa-graduation-cap"></i> My Grades</a>
            </li>
            <li class="logout">
                <a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </nav>
</div>

<style>
/* Sidebar Specific Styles */
.sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: white;
    position: fixed;
    height: 100%;
    overflow-y: auto;
    transition: all 0.3s;
    z-index: 1000;
}

.sidebar .logo {
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar .logo img {
    max-width: 120px;
    margin-bottom: 10px;
}

.sidebar .logo h2 {
    font-size: 1.1rem;
    color: white;
    margin: 0;
}

.sidebar nav ul {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.sidebar nav ul li {
    margin: 0;
}

.sidebar nav ul li a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s;
}

.sidebar nav ul li a i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
    font-size: 1.1rem;
}

.sidebar nav ul li a:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: white;
}

.sidebar nav ul li.active a {
    background-color: #0056b3;
    color: white;
    border-left: 3px solid #fff;
}

.sidebar nav ul li.logout a {
    color: rgba(255, 255, 255, 0.6);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin-top: 20px;
}

.sidebar nav ul li.logout a:hover {
    color: white;
    background-color: rgba(231, 74, 59, 0.2);
}

/* Responsive Sidebar */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    
    .sidebar nav ul {
        display: flex;
        flex-wrap: wrap;
    }
    
    .sidebar nav ul li {
        flex: 1 0 auto;
    }
    
    .sidebar nav ul li.logout {
        flex-basis: 100%;
    }
}

@media (max-width: 480px) {
    .sidebar nav ul li {
        flex-basis: 100%;
    }
}
</style>