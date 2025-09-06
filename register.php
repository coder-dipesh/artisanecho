<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = "member";

    if (!empty($name) && !empty($email) && !empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$name, $email, $hash, $role]);
            $success = " Registration successful! Redirecting to login...";
            echo "<script>
                setTimeout(() => { window.location.href = 'login.php'; }, 1500);
            </script>";
        } catch (PDOException $e) {
            $error = "Email is already registered!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description"
    content="Artisan Echo - Music courses, instruments, and creative workshops. Join us to learn and grow your musical journey.">
  <meta name="keywords" content="music courses, instrument lessons, creative workshops, artisan echo, online music shop">
  <meta name="author" content="Dipesh Siwakoti">
  <meta name="robots" content="index, follow">
  <title>Register | Artisan Echo</title>
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon_io/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon_io/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon_io/favicon-16x16.png" />
  <link rel="stylesheet" href="css/base.css" />
  <link rel="stylesheet" href="css/auth.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'includes/header.php'; ?>

  <main id="main">
    <section class="container contact-panel auth-panel">
      <form method="POST" class="contact-form" id="registerForm" novalidate>
        <?php if (!empty($error)): ?>
        <div class="form-msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
        <div class="form-msg success"><?= $success ?></div>
        <?php endif; ?>

        <h1>Create your Artisan account</h1>
        <p class="body-text">Welcome! Please enter your details.</p>

        <div class="form-group">
          <label for="full_name">Full Name</label>
          <input id="full_name" name="full_name" type="text" required />
          <small class="error-text" id="err-name"></small>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" required />
          <small class="error-text" id="err-email"></small>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required />
          <small class="error-text" id="err-pass"></small>
        </div>

        <button class="btn btn-primary" type="submit">Create an account</button>
        <p class="text-small">Already have an account? <a href="login.php">Login here</a></p>
      </form>

      <div class="auth-image">
        <img src="assets/img/register.png" alt="Register illustration">
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="js/register.js"></script>
</body>

</html>