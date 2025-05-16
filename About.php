<?php
// Include database connection if needed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbeeacadamy";

// Create connection
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
    <title>About Us - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* About Page Specific Styles */
        .about-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .about-hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .about-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .about-hero p {
            font-size: 1.2rem;
            color: #555;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        .mission-vision {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .mission-card, .vision-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .mission-card h2, .vision-card h2 {
            color: #0056b3;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .stats-section {
            background: #2c3e50;
            color: white;
            padding: 60px 20px;
            text-align: center;
            margin-bottom: 50px;
            border-radius: 8px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .stat-item {
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #0056b3;
        }

        .stat-label {
            font-size: 1.1rem;
        }

        .team-section {
            margin-bottom: 50px;
        }

        .team-section h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
            font-size: 2rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .team-member {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }

        .team-photo {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .team-info {
            padding: 20px;
        }

        .team-info h3 {
            margin: 0 0 5px 0;
            color: #2c3e50;
        }

        .team-info p {
            color: #666;
            margin: 0 0 15px 0;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-links a {
            color: #0056b3;
            font-size: 1.2rem;
        }

        .values-section {
            margin-bottom: 50px;
        }

        .values-section h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
            font-size: 2rem;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .value-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }

        .value-icon {
            font-size: 2.5rem;
            color: #0056b3;
            margin-bottom: 20px;
        }

        .value-card h3 {
            margin: 0 0 15px 0;
            color: #2c3e50;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .about-hero {
                padding: 60px 20px;
            }
            
            .about-hero h1 {
                font-size: 2rem;
            }
            
            .mission-vision {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .team-grid, .values-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
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
            </div> </ul>
        </nav>
    </header>

    <main class="about-page">
        <section class="about-hero">
            <h1>About BIXBEE</h1>
            <p>Empowering learners worldwide with cutting-edge education technology and innovative learning solutions.</p>
            <div class="btn-group">
                <button class="btn">Join Our Community</button>
                <button class="btn secondary-btn">Explore Courses</button>
            </div>
        </section>

        <section class="mission-vision">
            <div class="mission-card">
                <h2>Our Mission</h2>
                <p>To democratize education by providing accessible, affordable, and high-quality learning opportunities to anyone, anywhere. We believe that education should be a right, not a privilege, and we're committed to breaking down barriers to learning through technology and innovation.</p>
            </div>
            <div class="vision-card">
                <h2>Our Vision</h2>
                <p>To create a world where anyone can learn anything at any time, transforming lives through education. We envision a future where geographical location, financial status, or background don't limit one's ability to access world-class education and develop skills for the modern workforce.</p>
            </div>
        </section>

        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Active Learners</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Courses Available</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Satisfaction Rate</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Countries Reached</div>
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="Pics/team1.jpg" alt="Team Member" class="team-photo">
                    <div class="team-info">
                        <h3>Alex Johnson</h3>
                        <p>Founder & CEO</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <img src="Pics/team2.jpg" alt="Team Member" class="team-photo">
                    <div class="team-info">
                        <h3>Sarah Williams</h3>
                        <p>Chief Learning Officer</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <img src="Pics/team3.jpg" alt="Team Member" class="team-photo">
                    <div class="team-info">
                        <h3>Michael Chen</h3>
                        <p>Lead Instructor</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <img src="Pics/team4.jpg" alt="Team Member" class="team-photo">
                    <div class="team-info">
                        <h3>Emily Rodriguez</h3>
                        <p>Student Success Manager</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="values-section">
            <h2>Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Excellence</h3>
                    <p>We strive for the highest quality in everything we do, from course content to student support.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>We believe learning happens best in a supportive, collaborative environment.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>We constantly explore new ways to make learning more effective and engaging.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Accessibility</h3>
                    <p>We're committed to making education available to everyone, regardless of circumstances.</p>
                </div>
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