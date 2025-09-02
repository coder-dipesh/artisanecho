<?php
session_start();
require 'db.php';

$success = "";
$error = "";

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
            $success = "Registration successful! You can now <a href='login.php'>login here</a>.";
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
  <title>Register | Artisan Echo</title>
  <link rel="stylesheet" href="css/base.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'includes/header.php'; ?>



  <main id="main">

    <section class="container contact-panel">

      <form method="POST" class="contact-form" novalidate>

        <?php if (!empty($error)): ?>
        <div class="form-msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
        <div class="form-msg success"><?= $success ?></div>
        <script>
        setTimeout(() => {
          window.location.href = "login.php";
        }, 3000);
        </script>
        <?php endif; ?>

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

        <button class="btn btn-primary" type="submit">Register</button>
        <p class="small">Already have an account? <a href="login.php">Login here</a></p>
      </form>

    </section>
  </main>

  <script>
  const form = document.querySelector("form");

  form.addEventListener("submit", function(e) {
    let valid = true;

    // Reset error messages
    document.querySelectorAll(".error-text").forEach(el => el.innerText = "");
    document.querySelectorAll("input").forEach(el => el.classList.remove("error", "success"));

    // Full name validation
    const name = document.getElementById("full_name");
    if (name.value.trim().length < 3) {
      document.getElementById("err-name").innerText = "Name must be at least 3 characters.";
      name.classList.add("error");
      valid = false;
    } else {
      name.classList.add("success");
    }

    // Email validation
    const email = document.getElementById("email");
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    if (!emailPattern.test(email.value)) {
      document.getElementById("err-email").innerText = "Enter a valid email address.";
      email.classList.add("error");
      valid = false;
    } else {
      email.classList.add("success");
    }

    // Password validation
    const pass = document.getElementById("password");
    if (pass.value.length < 6) {
      document.getElementById("err-pass").innerText = "Password must be at least 6 characters.";
      pass.classList.add("error");
      valid = false;
    } else {
      pass.classList.add("success");
    }

    if (!valid) e.preventDefault();
  });

  form.querySelectorAll("input").forEach(input => {
    input.addEventListener("input", () => {
      form.dispatchEvent(new Event("submit", {
        cancelable: true
      }));
    });
  });
  </script>

  <?php include 'includes/footer.php'; ?>


</body>

</html>