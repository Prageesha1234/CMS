<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

// Check if ID is provided and valid
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Course ID is required']);
    exit();
}

$courseId = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if ($courseId === false || $courseId <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid course ID']);
    exit();
}

try {
    $sql = "SELECT course_id, title, description, duration_weeks AS duration, level, price 
            FROM courses 
            WHERE course_id = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }
    
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'title' => $course['title'],
            'description' => $course['description'],
            'duration' => $course['duration'],
            'level' => $course['level'],
            'price' => $course['price']
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'error' => 'Course not found'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Server error: ' . $e->getMessage()
    ]);
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>