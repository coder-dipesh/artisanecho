<?php
session_start();

// Redirect user to home if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role']    = $user['role'];
            $_SESSION['name']    = $user['full_name'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Both fields are required!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Artisan Echo</title>
  <link rel="stylesheet" href="css/base.css" />
  <link rel="stylesheet" href="css/auth.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'includes/header.php'; ?>

  <main id="main">


    <section class="container contact-panel">

      <form method="POST" class="contact-form" novalidate>
        <h1 style="font-size:1.9rem; padding:0;">Login</h1>
        <p class="body-text">Welcome back! Access your account to continue.</p>
        <?php if (!empty($error)): ?>
        <div class="form-msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
        <div class="form-msg success"><?= $success ?></div>
        <?php endif; ?>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" required />
          <small class="error-text" id="err-email"></small>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="password-wrapper">
            <input id="password" name="password" type="password" required />

          </div>
          <small class="error-text" id="err-pass"></small>
        </div>


        <button class="btn btn-primary" type="submit">Login</button>
        <p class="font-small">Don’t have an account ? <a class="link" href="register.php">Register here</a></p>
      </form>
      <div class="auth-image">
        <img src="assets/img/login.png" alt="Login Illustration">
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>

  <script src="js/login.js"></script>
</body>

</html>