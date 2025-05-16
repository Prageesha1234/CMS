<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Registration Type</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgb(220, 240, 43), #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .selection-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .option-btn {
            display: block;
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .option-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="selection-container">
        <h1>Register As</h1>
        <button onclick="location.href='student_regform.php'" class="option-btn">Student</button>
        <button onclick="location.href='instructor_regform.php'" class="option-btn">Instructor</button>
    </div>
</body>
</html>