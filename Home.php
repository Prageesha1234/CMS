<?php
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbeeacadamy";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - Modern LMS Platform</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="script" href="script.js">
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

    <section class="hero">
    <div class="hero-content">
        <img src="hero-image.jpg" alt="Hero Image" class="hero-image">
        <div class="overlay-text">  <h1>Welcome to BIXBEE</h1>
        <h1>The #1 Learning Platform for Modern Teams</h1>
        <p>Your gateway to a world of knowledge and skills.</p>
        <p>Empower your workforce with cutting-edge learning technology that drives engagement, skill development, and business growth.</p></div><br><br>
        <div class="btn-group">
            <button class="btn">Join with Us</button>
            <button class="btn secondary-btn">Who We Are</button>
        </div>
    </section>

    <section class="partners">
        <h2>Trusted by leading organizations worldwide</h2>
        <div class="partner-logos">
            <div class="partner-card">
                <h3>Microsoft</h3>
                <img src="logos\microsoft-logo.webp" alt="Microsoft Logo" class="partner-logo">
            </div>
            <div class="partner-card">
                <h3>Amazon Web Services</h3>
                <img src="logos\AWS-logo.png" alt="AWS Logo" class="partner-logo">
            </div>
            <div class="partner-card">
                <h3>Oracle</h3>
                <img src="logos\oracle-logo.png" alt="Oracle Logo" class="partner-logo">
            </div>
            <div class="partner-card">
                <h3>IBM</h3>
                <img src="logos\ibm-logo.png" alt="IBM Logo" class="partner-logo">
            </div>
            <div class="partner-card">
                <h3>Google</h3>
                <img src="logos\google.webp" alt="IBM Logo" class="partner-logo">
            </div>
        </div>
    </section>
    <section class="hero">
        <h1>Why Choose BIXBEE?</h1>
         <div class="w3-row w3-padding-64" id="library">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="Pics\feature1.jpg" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="750">
    </div>
    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Comprehensive Course Library</h1><br>
      <p class="w3-large">comprehensive course library represents an extensive collection of learning resources covering a wide array of subjects and skills. Typically offered by online platforms or institutions, these libraries aim to provide learners with access to a diverse catalog of courses, often spanning from introductory to advanced levels. The goal is to offer a holistic learning experience, enabling individuals to explore new interests, deepen existing knowledge, and acquire valuable skills through structured educational content delivered in various formats.</p>
      </div></div>
      
      <div class="w3-row w3-padding-64" id="library">
      <div class="w3-col m6 w3-padding-large ">
      <h1 class="w3-center">Interactive Learning Experience</h1><br>
      <p class="w3-large">An interactive learning experience goes beyond passive consumption of information by actively engaging the learner in the educational process. This can involve activities like simulations, quizzes with immediate feedback, discussions with peers and instructors, interactive exercises, and personalized learning paths that adapt to the learner's progress. The focus is on fostering deeper understanding, critical thinking, and practical application of knowledge through active participation and immediate engagement.</p>
      </div>
      <div class="w3-col l6 w3-padding-large w3-hide-small">
      <img src="Pics\ILE.webp" class="w3-round w3-image w3-opacity-min" alt="Menu" style="width:100%">
    </div></div>

    <br>
    <div class="w3-row w3-padding-64" id="library">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="Pics\ExpertInstructors.avif" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="600">
    </div>
    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Expert Instructors</h1><br>
      <p class="w3-large">An environment with expert instructors provides learners with significant advantages due to the depth of knowledge, practical experience, and refined teaching skills these individuals possess. Expert instructors typically have a strong command of their subject matter, often backed by years of experience in the field. This allows them to explain complex concepts clearly, provide real-world examples, and share valuable insights that go beyond textbooks.</p>
      </div></div>
  </section>
  <div class="w3-row w3-padding-64" id="library">
  <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Flexible Learning Paths</h1><br>
      <p class="w3-large">Flexible learning paths empower learners by offering choices in how, when, and at what pace they progress through educational content. Unlike rigid, one-size-fits-all curricula, flexible paths often allow individuals to select modules or topics based on their specific goals, prior knowledge, and learning styles. This can involve options for self-paced learning, where individuals can move through materials at their own speed, or the ability to choose from various electives and specializations. Flexible learning paths cater to diverse needs and schedules, making education more accessible and personalized, ultimately leading to increased engagement and more effective learning outcomes.</p>
      </div>
      
      <div class="w3-col l6 w3-padding-large w3-hide-small">
      <img src="Pics\Flexible Learning Paths.png" class="w3-round w3-image w3-opacity-min" alt="Menu" style="width:100%">
    </div></div>
    <br>
    <div class="w3-row w3-padding-64" id="library">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="Pics\Progress_Tracker.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="600">
    </div>
    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">Progress Tracking</h1><br>
      <p class="w3-large">Progress tracking provides learners and educators with valuable insights into the learning journey. It involves monitoring and recording a learner's advancement through a course or curriculum, often utilizing tools that visualize completed modules, assessment scores, and areas needing attention. Effective progress tracking helps learners stay motivated by showcasing their achievements and identifying areas where they might need to focus more effort. For educators, it offers data to understand learner engagement, identify potential difficulties within the course design, and provide targeted support. Ultimately, progress tracking fosters a more transparent and data-informed learning experience, enabling both learners and instructors to optimize their efforts for better outcomes.</p>
      </div></div>

 <section class="course-carousel">
    <div class="course-header">
        <h1>Our Courses</h1>
        <a href="course.php" class="see-all-btn">See All Courses</a>
    </div>
    
    <div class="courses-slider">
        <?php
        // Fetch courses from database
        $sql = "SELECT * FROM courses LIMIT 8";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="course-card">';
                echo '<h3>' . $row['title'] . '</h3>';
                echo '<p>' . substr($row['description'], 0, 100) . '...</p>';
                echo '<div class="course-meta">';
                echo '<span class="level">' . $row['level'] . '</span>';
                echo '<span class="duration">' . $row['duration_weeks'] . ' weeks</span>';
                echo '</div>';
                echo '<a href="course.php?course_id=' . $row['id'] . '" class="btn">View Course</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No courses available at the moment.</p>';
        }
        ?>
    </div>
</section>
    <h1>Courses</h1>


 </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.courses-slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>


</body>
</html>