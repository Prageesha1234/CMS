<?php
session_start();
require_once 'db_connect.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required POST keys are set
    if (isset($_POST['username'], $_POST['fullname'], $_POST['email'], $_POST['age'], $_POST['country'], $_POST['password'])) {
        // Sanitize input
        $username = $conn->real_escape_string($_POST['username']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $email = $conn->real_escape_string($_POST['email']);
        $age = (int)$_POST['age'];
        $country = $conn->real_escape_string($_POST['country']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Insert user into database
        $sql = "INSERT INTO users (username, fullname, email, age, country, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiss", $username, $fullname, $email, $age, $country, $password);

        try {
            if ($stmt->execute()) {
                echo "<div class='success-container'>
                        <p>Registration successful!</p>
                        <a href='login.php' class='return-login'>Return to Login</a>
                      </div>";
                echo "<style>
                        body {
                            margin: 0;
                            padding: 0;
                            font-family: 'Poppins', sans-serif;
                            background: linear-gradient(135deg,rgb(220, 240, 43), #2575fc);
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                        }
                        .success-container {
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background-color: #f0f8ff;
                            padding: 50px;
                            border: 1px solid #ccc;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                            text-align: center;
                            z-index: 1000;
                            border-radius: 15px;
                        }
                        .return-login {
                            display: inline-block;
                            margin-top: 10px;
                            padding: 20px 30px;
                            background-color: #007bff;
                            color: #fff;
                            text-decoration: none;
                            border-radius: 5px;
                        }
                        .return-login:hover {
                            background-color: #0056b3;
                        }
                      </style>";
            } else {
                if ($conn->errno === 1062) { // Duplicate entry error
                    echo "<div class='error-container'>Error: Username or email already exists. Please try again with different credentials.</div>";
                } else {
                    echo "<div class='error-container'>Error: Unable to register. Please try again later.</div>";
                }
            }
        } catch (mysqli_sql_exception $e) {
            error_log("Database error: " . $e->getMessage());
            echo "<div class='error-container'>Error: Unable to register. Please try again later.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='error-container'>Error: All fields are required. Please fill out the form completely.</div>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="Form.css">
    <script src="validation.js" defer></script>
</head>
<body>
    <div class="form-container">
        <h1>Join  With US</h1>
        <form action="student_regform.php" method="POST" onsubmit="return validateForm()">
            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="education_level">Education Level:</label>
            <select id="education_level" name="education_level">
                <option value="high_school">High School</option>
                <option value="undergraduate">Undergraduate</option>
                <option value="graduate">Graduate</option>
            </select>
            
            <button type="submit">Register</button>
        </form>
    </div>
    
</body>
</html>