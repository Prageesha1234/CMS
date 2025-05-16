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

// Process form submission
$formSubmitted = false;
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $plan = trim($_POST['plan'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validate inputs
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email';
    }
    
    if (empty($message)) {
        $errors['message'] = 'Message is required';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        $formSubmitted = true;
        
        // Prepare email content
        $to = "contact@bixbee.com"; // Replace with your email
        $subject = "New Contact Form Submission - " . htmlspecialchars($plan);
        $emailContent = "
            <html>
            <head>
                <title>New Contact Form Submission</title>
            </head>
            <body>
                <h2>New Contact Request</h2>
                <p><strong>Plan:</strong> " . htmlspecialchars($plan) . "</p>
                <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                <p><strong>Message:</strong></p>
                <p>" . nl2br(htmlspecialchars($message)) . "</p>
            </body>
            </html>
        ";
        
        // Email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . htmlspecialchars($name) . " <" . htmlspecialchars($email) . ">" . "\r\n";
        
        // Send email (commented out for safety - uncomment in production)
        // $success = mail($to, $subject, $emailContent, $headers);
        $success = true; // For testing purposes
    }
}

// Get plan from query string if available
$selectedPlan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : 'General Inquiry';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Contact Page Specific Styles */
        .contact-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .contact-hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .contact-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .contact-hero p {
            font-size: 1.2rem;
            color: #555;
            max-width: 700px;
            margin: 0 auto 30px;
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }

        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .contact-form h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #0056b3;
            outline: none;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .submit-btn {
            background: #0056b3;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background: #004182;
        }

        .contact-info {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .contact-info h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .info-icon {
            background: #f5f7fa;
            color: #0056b3;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .info-content h3 {
            margin: 0 0 5px 0;
            color: #2c3e50;
        }

        .info-content p {
            margin: 0;
            color: #666;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .contact-hero {
                padding: 60px 20px;
            }
            
            .contact-hero h1 {
                font-size: 2rem;
            }
            
            .contact-container {
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
            </div></ul>
        </nav>
    </header>

    <main class="contact-page">
        <section class="contact-hero">
            <h1>Get in Touch</h1>
            <p>Have questions about our courses or pricing plans? Our team is here to help you with any inquiries.</p>
        </section>

        <?php if ($formSubmitted && $success): ?>
        <div class="success-message">
            <h3>Thank you for contacting us!</h3>
            <p>We've received your message and will get back to you within 24 hours.</p>
        </div>
        <?php endif; ?>

        <div class="contact-container">
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form method="POST" action="contact.php">
                    <div class="form-group">
                        <label for="plan">Regarding</label>
                        <select name="plan" id="plan" class="form-control">
                            <option value="General Inquiry" <?php echo $selectedPlan === 'General Inquiry' ? 'selected' : ''; ?>>General Inquiry</option>
                            <option value="Standard Plan" <?php echo $selectedPlan === 'Standard Plan' ? 'selected' : ''; ?>>Standard Plan</option>
                            <option value="Premium Plan" <?php echo $selectedPlan === 'Premium Plan' ? 'selected' : ''; ?>>Premium Plan</option>
                            <option value="Enterprise Plan" <?php echo $selectedPlan === 'Enterprise Plan' ? 'selected' : ''; ?>>Enterprise Plan</option>
                            <option value="Custom Solution" <?php echo $selectedPlan === 'Custom Solution' ? 'selected' : ''; ?>>Custom Solution</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        <?php if (isset($errors['name'])): ?>
                            <div class="error-message"><?php echo $errors['name']; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <?php if (isset($errors['email'])): ?>
                            <div class="error-message"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea name="message" id="message" class="form-control"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <div class="error-message"><?php echo $errors['message']; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info">
                <h2>Contact Information</h2>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Our Location</h3>
                        <p>Colombo<br>Sri Lanka</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h3>Email Us</h3>
                        <p>contact@bixbee.com<br>support@bixbee.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Call Us</h3>
                        <p>+94 (112) 123-4567<br>Mon-Fri, 9am-5pm EST</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="info-content">
                        <h3>Live Chat</h3>
                        <p>Available 24/7<br>via our support portal</p>
                    </div>
                </div>
            </div>
        </div>
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