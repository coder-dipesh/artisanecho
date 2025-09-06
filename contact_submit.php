<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

$first = trim($_POST['first'] ?? '');
$last = trim($_POST['last'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($first && $last && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
    try {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, first_name, last_name, email, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'] ?? null,
            $first,
            $last,
            $email,
            $message
        ]);
        echo json_encode(["status" => "success", "msg" => "🎉 Thank you for contacting us! We'll get back to you soon."]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "msg" => "⚠️ Failed to send message. Please try again later."]);
    }
} else {
    echo json_encode(["status" => "error", "msg" => "⚠️ All fields are required and email must be valid."]);
}