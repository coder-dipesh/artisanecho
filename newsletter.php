<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['newsletter_email'])) {
    $email = trim($_POST['newsletter_email']);
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO newsletter_subs (email) VALUES (?)");
            $stmt->execute([$email]);
            echo json_encode(["status" => "success", "message" => "You’ve subscribed successfully!"]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "This email is already subscribed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Please enter a valid email address."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}