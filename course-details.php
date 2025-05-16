<?php
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbeeacadamy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if course ID is provided
if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    header("Location: course.php");
    exit();
}

$course_id = $_GET['course_id'];

// Fetch course details
$sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: course.php");
    exit();
}

$course = $result->fetch_assoc();

// Fetch instructor details if available
$instructor = null;
if ($course['instructor_id']) {
    $instructor_sql = "SELECT * FROM users WHERE id = ?";
    $instructor_stmt = $conn->prepare($instructor_sql);
    $instructor_stmt->bind_param("i", $course['instructor_id']);
    $instructor_stmt->execute();
    $instructor_result = $instructor_stmt->get_result();
    
    if ($instructor_result->num_rows > 0) {
        $instructor = $instructor_result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <header>
        <h1>BIXBEE</h1>
        <nav class="nav">
            <ul class="nav-links">
                <li><a href="Index.php">Home</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="course.php">Course</a></li>
                <li><a href="price.php">Plans</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <button class="btn">Login / Sign In</button>
            <div class="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <main class="course-details-container">
        <section class="course-hero">
            <div class="course-hero-content">
                <?php if ($course['thumbnail_url']): ?>
                    <img src="<?php echo htmlspecialchars($course['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" class="course-hero-image">
                <?php else: ?>
                    <div class="course-hero-placeholder">No Image Available</div>
                <?php endif; ?>
                <div class="course-hero-text">
                    <h1><?php echo htmlspecialchars($course['title']); ?></h1>
                    <div class="course-meta">
                        <span class="level">Level: <?php echo htmlspecialchars($course['level']); ?></span>
                        <span class="duration">Duration: <?php echo htmlspecialchars($course['duration_weeks']); ?> weeks</span>
                        <?php if ($course['price']): ?>
                            <span class="price">$<?php echo htmlspecialchars($course['price']); ?></span>
                        <?php endif; ?>
                    </div>
                    <button class="btn enroll-btn">Enroll Now</button>
                </div>
            </div>
        </section>

        <section class="course-content">
            <div class="course-description">
                <h2>Course Description</h2>
                <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
            </div>

            <div class="course-details-grid">
                <div class="course-detail-card">
                    <h3>What You'll Learn</h3>
                    <ul class="learning-outcomes">
                        <!-- You could add specific learning outcomes to your database -->
                        <li>Master the fundamentals of <?php echo explode('-', $course['title'])[0]; ?></li>
                        <li>Build practical projects</li>
                        <li>Develop problem-solving skills</li>
                        <li>Prepare for real-world applications</li>
                    </ul>
                </div>

                <?php if ($instructor): ?>
                <div class="course-detail-card instructor-card">
                    <h3>Instructor</h3>
                    <div class="instructor-info">
                        <h4><?php echo htmlspecialchars($instructor['fullname']); ?></h4>
                        <?php if ($instructor['qualification']): ?>
                            <p class="qualification"><?php echo htmlspecialchars($instructor['qualification']); ?></p>
                        <?php endif; ?>
                        <?php if ($instructor['experience']): ?>
                            <p class="experience"><?php echo htmlspecialchars($instructor['experience']); ?> years of experience</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="course-detail-card requirements-card">
                    <h3>Requirements</h3>
                    <ul>
                        <li>Basic computer skills</li>
                        <li>Internet connection</li>
                        <li>Dedication to learn</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="related-courses">
            <h2>Related Courses</h2>
            <div class="related-courses-grid">
                <?php
                // Fetch related courses (same category or similar level)
                $related_sql = "SELECT * FROM courses 
                               WHERE (category = ? OR level = ?) AND id != ?
                               LIMIT 3";
                $related_stmt = $conn->prepare($related_sql);
                $related_stmt->bind_param("ssi", $course['category'], $course['level'], $course['id']);
                $related_stmt->execute();
                $related_result = $related_stmt->get_result();
                
                if ($related_result->num_rows > 0) {
                    while($related_course = $related_result->fetch_assoc()) {
                        echo '<div class="related-course-card">';
                        echo '<a href="course-details.php?course_id=' . $related_course['id'] . '">';
                        if ($related_course['thumbnail_url']) {
                            echo '<img src="' . htmlspecialchars($related_course['thumbnail_url']) . '" alt="' . htmlspecialchars($related_course['title']) . '">';
                        }
                        echo '<h4>' . htmlspecialchars($related_course['title']) . '</h4>';
                        echo '<span class="level">' . htmlspecialchars($related_course['level']) . '</span>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No related courses found.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <!-- Your footer content here -->
    </footer>
</body>
</html>