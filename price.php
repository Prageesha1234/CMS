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

// Fetch pricing data from database
$sql = "SELECT * FROM package";
$result = $conn->query($sql);
$packages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans - BIXBEE</title>
    <link rel="stylesheet" href="Style.css">
    <style>
        /* Pricing Page Specific Styles */
        .pricing-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .pricing-hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .pricing-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .pricing-hero p {
            font-size: 1.2rem;
            color: #555;
            max-width: 700px;
            margin: 0 auto 30px;
        }

        .pricing-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
        }

        .pricing-tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .pricing-tab.active {
            color: #0056b3;
            border-bottom: 3px solid #0056b3;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .pricing-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-5px);
        }

        .pricing-card.popular {
            border: 2px solid #0056b3;
        }

        .popular-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #0056b3;
            color: white;
            padding: 5px 15px;
            font-size: 0.8rem;
            font-weight: bold;
            border-bottom-left-radius: 8px;
        }

        .pricing-card h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 1.5rem;
        }

        .price-amount {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 20px 0;
        }

        .price-amount span {
            font-size: 1rem;
            color: #666;
        }

        .price-features {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        .price-features li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }

        .price-features li i {
            color: #0056b3;
            margin-right: 10px;
        }

        .contact-btn {
            display: block;
            text-align: center;
            padding: 12px;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .contact-btn:hover {
            background: #004182;
        }

        .faq-section {
            margin-top: 60px;
        }

        .faq-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .faq-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-question {
            padding: 15px 20px;
            background: #f5f7fa;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-answer.active {
            padding: 15px 20px;
            max-height: 500px;
        }

        .enterprise-contact {
            text-align: center;
            margin-top: 40px;
            padding: 30px;
            background: #f5f7fa;
            border-radius: 8px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .pricing-hero {
                padding: 60px 20px;
            }
            
            .pricing-hero h1 {
                font-size: 2rem;
            }
            
            .pricing-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .pricing-tab {
                width: 100%;
                text-align: center;
                border-bottom: 1px solid #ddd;
            }
            
            .pricing-grid {
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

    <main class="pricing-page">
        <section class="pricing-hero">
            <h1>Choose Your Learning Plan</h1>
            <p>Select the perfect plan for your learning journey with flexible options for individuals, teams, and enterprises.</p>
        </section>

        <div class="pricing-tabs">
            <div class="pricing-tab active">For Individuals</div>
            <div class="pricing-tab">For Teams</div>
            <div class="pricing-tab">For Enterprises</div>
        </div>

        <div class="pricing-grid">
            <?php foreach ($packages as $package): ?>
            <div class="pricing-card <?php echo $package['plan'] === 'Premium' ? 'popular' : ''; ?>">
                <?php if ($package['plan'] === 'Premium'): ?>
                <div class="popular-badge">Most Popular</div>
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($package['plan']); ?></h3>
                <div class="price-amount">
                    $<?php echo htmlspecialchars($package['price']); ?>
                    <span>/month</span>
                </div>
                <ul class="price-features">
                    <?php 
                    // Generate features based on plan type
                    $features = [];
                    if ($package['plan'] === 'Standard') {
                        $features = [
                            'Access to all beginner courses',
                            'Community support',
                            'Certificate of completion',
                            'Weekly learning resources'
                        ];
                    } elseif ($package['plan'] === 'Premium') {
                        $features = [
                            'All Standard features',
                            'Access to intermediate & advanced courses',
                            'Priority support',
                            'Project feedback',
                            'Monthly live Q&A sessions'
                        ];
                    } elseif ($package['plan'] === 'Enterprise') {
                        $features = [
                            'All Premium features',
                            'Dedicated account manager',
                            'Custom learning paths',
                            'Team progress analytics',
                            'On-demand training sessions',
                            'API access'
                        ];
                    }
                    
                    foreach ($features as $feature): ?>
                    <li><i class="fas fa-check"></i> <?php echo htmlspecialchars($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="contact.php?plan=<?php echo urlencode($package['plan']); ?>" class="contact-btn">
                    Contact Us
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="enterprise-contact">
            <h3>Need a Custom Solution?</h3>
            <p>Our enterprise team can create a tailored learning platform for your organization's specific needs.</p>
            <a href="contact.php?plan=Custom" class="contact-btn" style="max-width: 200px; margin: 20px auto 0;">
                Request a Demo
            </a>
        </div>

        <section class="faq-section">
            <h2>Frequently Asked Questions</h2>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>What payment methods do you accept?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>We accept all major credit cards, PayPal, and bank transfers for annual plans. Enterprise customers may also request invoice payments.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>Can I switch plans later?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, you can upgrade or downgrade your plan at any time. Your billing will be prorated based on your usage.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>Is there a free trial available?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>We offer a 7-day free trial for our Premium plan. No credit card required to start your trial.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>How does team pricing work?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Team plans are priced per user with volume discounts available. Contact us for specific pricing based on your team size.</p>
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

        // FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.classList.toggle('active');
                
                const icon = question.querySelector('i');
                if (answer.classList.contains('active')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        });

        // Pricing tabs functionality
        document.querySelectorAll('.pricing-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelector('.pricing-tab.active').classList.remove('active');
                tab.classList.add('active');
                
                // Here you would typically show different plans based on the tab
                // For this example, we're just changing the active tab style
            });
        });
    </script>
</body>
</html>