<?php
session_start();
require 'db.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM courses WHERE course_id = ?");
$stmt->execute([$id]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if ($course) {
    echo json_encode([
        "id" => $course['course_id'],
        "title" => $course['title'],
        "description" => $course['description'],
        "level" => ucfirst($course['level']),
        "instrument" => $course['instrument'],
        "duration" => $course['duration'],
        "age_group" => ucfirst($course['age_group'])
    ]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Course not found"]);
}
