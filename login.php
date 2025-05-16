<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        
        // Modified query to include user_type
        $stmt = $conn->prepare("SELECT id, username, password, user_type FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("Prepare statement failed: " . $conn->error);
            die("An error occurred. Please try again later.");
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            error_log("Execute statement failed: " . $stmt->error);
            die("An error occurred. Please try again later.");
        }
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password, $user_type);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['user_type'] = $user_type;
                
                // Redirect based on user type
                switch($user_type) {
                    case 'admin':
                        header("Location: admin_dashboard.php");
                        break;
                    case 'instructor':
                        header("Location: instructor_dashboard.php");
                        break;
                    case 'student':
                        header("Location: student_dashboard.php");
                        break;
                    default:
                        header("Location: Home.php");
                }
                exit();
            } else {
                $error = "Invalid email or password";
            }
        } else {
            $error = "Invalid email or password";
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIXBEE - Login</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        
        .login-container img {
            width: 120px;
            margin-bottom: 20px;
        }
        
        .login-container h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }
        
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #004182;
        }
        
        .forgot-password {
            display: block;
            margin-top: 15px;
            color: #0056b3;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .signup-link {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #666;
        }
        
        .signup-link a {
            color: #0056b3;
            text-decoration: none;
            font-weight: 600;
        }
        
        .error-message {
            color: #dc3545;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo1.PNG" alt="BIXBEE Logo" class="logo">
        <h2>Welcome to BIXBEE</h2>
        
        <?php if(isset($error)): ?>
        <div class="error-message">Invalid email or password. Please try again.</div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="select_user_type.php">Sign Up</a>
        </div>
    </div>
</body>
</html>