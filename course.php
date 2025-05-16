<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbeeacadamy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter parameters
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$level_filter = isset($_GET['level']) ? $_GET['level'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Build SQL query with filters
$sql = "SELECT * FROM courses WHERE 1=1";
$params = [];
$types = '';

if (!empty($category_filter)) {
    $sql .= " AND category = ?";
    $params[] = $category_filter;
    $types .= 's';
}

if (!empty($level_filter)) {
    $sql .= " AND level = ?";
    $params[] = $level_filter;
    $types .= 's';
}

if (!empty($search_query)) {
    $sql .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
    $types .= 'ss';
}

$sql .= " ORDER BY title ASC";

// Prepare and execute query
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Courses - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body{
            background-color:rgb(209, 223, 243)
        }
        /* Courses Page Specific Styles */
        .courses-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .courses-hero {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .courses-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .courses-hero p {
            font-size: 1.2rem;
            color: #555;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Filter Styles */
        .course-filters {
            margin-bottom: 40px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .filter-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px;
            padding-right: 50px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 1rem;
        }

        .search-box button {
            position: absolute;
            right: 5px;
            top: 5px;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-group label {
            font-weight: bold;
            color: #555;
        }

        .filter-group select {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }

        .filter-btn, .reset-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .filter-btn {
            background: #0056b3;
            color: white;
        }

        .filter-btn:hover {
            background: #004182;
        }

        .reset-btn {
            background: #f5f5f5;
            color: #333;
            text-decoration: none;
        }

        .reset-btn:hover {
            background: #e0e0e0;
        }

        /* Course Grid Styles */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .course-item {
            transition: transform 0.3s ease;
        }

        .course-item:hover {
            transform: translateY(-5px);
        }

        .course-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-thumbnail {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .course-thumbnail.placeholder {
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 3rem;
        }

        .course-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .course-info h3 {
            margin: 0 0 10px 0;
            color: #2c3e50;
        }

        .course-level {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .course-level.beginner {
            background: #e3f2fd;
            color: #1565c0;
        }

        .course-level.intermediate {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .course-level.advanced {
            background: #ffebee;
            color: #c62828;
        }

        .course-desc {
            color: #555;
            margin: 0 0 15px 0;
            flex-grow: 1;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .course-meta i {
            margin-right: 5px;
        }

        .course-price {
            font-weight: bold;
            color: #2c3e50;
        }

        .course-price.free {
            color: #2e7d32;
        }

        .view-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .view-btn:hover {
            background: #004182;
        }

        .no-results {
            text-align: center;
            grid-column: 1 / -1;
            padding: 50px 20px;
            color: #666;
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #999;
        }

        .no-results h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .courses-hero {
                padding: 40px 20px;
            }
            
            .courses-hero h1 {
                font-size: 2rem;
            }
            
            .filter-options {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .course-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
            
            <button class="btn" onclick="document.location='login.php'">Login / Sign In</button>
            <div class="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
            </ul>
        </nav>
    </header>

    <main class="courses-page">
        <section class="courses-hero">
            <h1>Our Course Catalog</h1>
            <p>Browse through our comprehensive selection of courses to find the perfect fit for your learning journey.</p>
        </section>

        <section class="course-filters">
            <form method="GET" action="course.php" class="filter-form">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Search courses..." value="<?php echo htmlspecialchars($search_query); ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                
                <div class="filter-options">
                    <div class="filter-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category">
                            <option value="">All Categories</option>
                            <?php
                            // Get unique categories from database
                            $cat_sql = "SELECT DISTINCT category FROM courses WHERE category IS NOT NULL";
                            $cat_result = $conn->query($cat_sql);
                            
                            while($cat = $cat_result->fetch_assoc()) {
                                $selected = ($category_filter == $cat['category']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($cat['category']) . '" ' . $selected . '>' . 
                                     htmlspecialchars($cat['category']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="level">Level:</label>
                        <select name="level" id="level">
                            <option value="">All Levels</option>
                            <option value="Beginner" <?php echo ($level_filter == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                            <option value="Intermediate" <?php echo ($level_filter == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                            <option value="Advanced" <?php echo ($level_filter == 'Advanced') ? 'selected' : ''; ?>>Advanced</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="filter-btn">Apply Filters</button>
                    <a href="course.php" class="reset-btn">Reset</a>
                </div>
            </form>
        </section>

        <section class="courses-list">
            <div class="course-grid">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="course-item">';
                        echo '<div class="course-card">';
                        
                        if (!empty($row['thumbnail_url'])) {
                            echo '<img src="' . htmlspecialchars($row['thumbnail_url']) . '" alt="' . htmlspecialchars($row['title']) . '" class="course-thumbnail">';
                        } else {
                            echo '<div class="course-thumbnail placeholder"><i class="fas fa-book-open"></i></div>';
                        }
                        
                        echo '<div class="course-info">';
                        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                        
                        if (!empty($row['level'])) {
                            echo '<span class="course-level ' . strtolower($row['level']) . '">' . htmlspecialchars($row['level']) . '</span>';
                        }
                        
                        echo '<p class="course-desc">' . substr(htmlspecialchars($row['description']), 0, 100) . '...</p>';
                        
                        echo '<div class="course-meta">';
                        echo '<span><i class="far fa-clock"></i> ' . htmlspecialchars($row['duration_weeks']) . ' weeks</span>';
                        
                        if (!empty($row['price'])) {
                            echo '<span class="course-price">$' . htmlspecialchars($row['price']) . '</span>';
                        } else {
                            echo '<span class="course-price free">Free</span>';
                        }
                        
                        echo '</div>';
                        
                        echo '<a href="course-details.php?course_id=' . $row['id'] . '" class="view-btn">View Course</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="no-results">';
                    echo '<i class="fas fa-book"></i>';
                    echo '<h3>No courses found</h3>';
                    echo '<p>Try adjusting your search or filters</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <!-- Your footer content here -->
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.menu-icon').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>