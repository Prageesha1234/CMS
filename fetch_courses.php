<?php
require_once 'db_connect.php';

$query = "SELECT title, description, thumbnail_url FROM courses ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($query);

$courses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($courses);
$conn->close();
?>
