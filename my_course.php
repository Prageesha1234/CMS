<?php
session_start();
require_once 'instructor_sidebar.php';
require_once 'db_connect.php'; // Assuming this file contains your database connection

// Check if user is logged in and is an instructor
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Get instructor ID from session
$instructor_id = $_SESSION['user_id'];

// Fetch courses assigned to this instructor
$courses = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE instructor_id = :instructor_id");
    $stmt->bindParam(':instructor_id', $instructor_id, PDO::PARAM_INT);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle error
    $error = "Error fetching courses: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - BIXBEE</title>
    <link rel="stylesheet" href="instructor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .course-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
        }
        .course-thumbnail {
            height: 160px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .course-thumbnail img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        .course-details {
            padding: 15px;
        }
        .course-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .course-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
        }
        .course-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .course-actions {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-view {
            background-color: #2196F3;
            color: white;
        }
        .no-courses {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <?php include 'instructor_sidebar.php'; ?>

        <div class="main-content">
            <header>
                <h1>My Courses</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <img src="../assets/images/user.png" alt="User">
                </div>
            </header>

            <div class="course-management">
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php elseif (empty($courses)): ?>
                    <div class="no-courses">
                        <i class="fas fa-book-open fa-3x" style="margin-bottom: 20px;"></i>
                        <h3>No Courses Assigned</h3>
                        <p>You haven't been assigned to any courses yet.</p>
                        <a href="create_course.php" class="btn" style="background-color: #4CAF50; color: white; margin-top: 15px;">
                            Create New Course
                        </a>
                    </div>
                <?php else: ?>
                    <div class="course-grid">
                        <?php foreach ($courses as $course): ?>
                            <div class="course-card">
                                <div class="course-thumbnail">
                                    <?php if ($course['thumbnail_url']): ?>
                                        <img src="<?php echo htmlspecialchars($course['thumbnail_url']); ?>" alt="Course Thumbnail">
                                    <?php else: ?>
                                        <i class="fas fa-book fa-4x" style="color: #ccc;"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="course-details">
                                    <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                                    <div class="course-meta">
                                        <span><i class="fas fa-level-up-alt"></i> <?php echo htmlspecialchars($course['level'] ?? 'Not specified'); ?></span>
                                        <span><i class="fas fa-users"></i> <?php echo htmlspecialchars($course['enrolledcount']); ?> students</span>
                                    </div>
                                    <p class="course-description"><?php echo htmlspecialchars($course['description']); ?></p>
                                    <div class="course-actions">
                                        <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="btn btn-edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="view_course.php?id=<?php echo $course['id']; ?>" class="btn btn-view">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>