<?php
session_start();
require_once 'db_connect.php'; // Your database connection file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $username = $conn->real_escape_string($_POST['username']);
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $age = (int)$_POST['age'];
    $country = $conn->real_escape_string($_POST['country']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_type = 'instructor'; // Fixed value for instructor
    $qualification = $conn->real_escape_string($_POST['qualification']);
    $experience = (int)$_POST['experience'];

    // Insert user into database
    $sql = "INSERT INTO users (username, fullname, email, age, country, password, user_type, qualification, experience) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissssi", $username, $fullname, $email, $age, $country, $password, $user_type, $qualification, $experience);

    if ($stmt->execute()) {
        echo "<div class='success-container'>
                <p>Instructor registration successful!</p>
                <a href='login.php' class='return-login'>Return to Login</a>
              </div>";
        // [Keep your existing success CSS styles here]
    } else {
        echo "<div class='error-container'>Error: Unable to register. Please try again later.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <link rel="stylesheet" href="Form.css">
    <style>
        /* Add instructor-specific styles */
        .form-container h1::after {
            content: " (Instructor)";
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Instructor Registration</h1>
        <form action="instructor_regform.php" method="POST">
            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" required>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required min="0">
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="qualification">Highest Qualification:</label>
            <input type="text" id="qualification" name="qualification" required>
            <label for="experience">Years of Experience:</label>
            <input type="number" id="experience" name="experience" required min="0">
            
            
            <button type="submit">Register as Instructor</button>
        </form>
    </div>
    
</body>
</html>