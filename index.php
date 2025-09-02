<?php
session_start();
require 'db.php';

$newsSuccess = "";
$newsError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['newsletter_email'])) {
    $email = trim($_POST['newsletter_email']);
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO newsletter_subs (email) VALUES (?)");
            $stmt->execute([$email]);
            $newsSuccess = "🎉 You’ve subscribed successfully!";
        } catch (PDOException $e) {
            $newsError = "⚠️ This email is already subscribed.";
        }
    } else {
        $newsError = "⚠️ Please enter a valid email address.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home | Artisan Echo</title>
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon_io/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon_io/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon_io/favicon-16x16.png" />
  <link rel="stylesheet" href="css/base.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'includes/header.php'; ?>

  <main id="main">
    <section class="hero hero-banner" aria-labelledby="hero-title">
      <div class="container hero-inner">
        <h1 id="hero-title">Learn. Play. Connect.</h1>
        <p class="body-text">Discover the rhythm of community at Artisan Echo.</p>
        <a class="btn btn-primary" href="contact.php#trial">Book a Free Trial Lesson</a>
      </div>
    </section>

    <section class="container intro-copy">
      <p class="lead">
        Artisan Echo is a local hub for music lovers — offering lessons for all ages and selling handcrafted
        instruments made by local artists. We’re here to inspire, teach, and grow our musical community.
      </p>
    </section>

    <section class="features container">
      <ul class="card-grid">
        <li class="card">
          <figure class="card-media">
            <img loading="lazy" src="./assets/img/lesson.png" alt="Guitar lesson" />
            <figcaption class="card-title">Music Lessons</figcaption>
          </figure>
          <p class="body-text">Tailored lessons in guitar, piano, vocals, and more. For beginners to advanced.</p>
        </li>
        <li class="card">
          <figure class="card-media">
            <img loading="lazy" src="./assets/img/instrument.png" alt="Handmade instrument" />
            <figcaption class="card-title">Music Instruments</figcaption>
          </figure>
          <p class="body-text">Shop unique, handcrafted instruments made by skilled local artisans.</p>
        </li>
        <li class="card">
          <figure class="card-media">
            <img loading="lazy" src="./assets/img/community.png" alt="Community event" />
            <figcaption class="card-title">Community Events</figcaption>
          </figure>
          <p class="body-text">Join open mic nights, workshops, and seasonal showcases.</p>
        </li>
      </ul>
    </section>

    <section class="stats">
      <div class="container">
        <ul class="stats-grid">
          <li><span class="stat">258+</span><span class="label">Students</span></li>
          <li><span class="stat">98+</span><span class="label">Successful Students</span></li>
          <li><span class="stat">120+</span><span class="label">Graduate Students</span></li>
          <li><span class="stat">57+</span><span class="label">Expert Teachers</span></li>
        </ul>
      </div>
    </section>

    <section class="why container">
      <div class="twocol">
        <figure class="promo-media">
          <img loading="lazy" src="./assets/img/why_artisan_echo.png" alt="Inside the studio" />
        </figure>
        <div>
          <h1 class="action-title">Why Artisan Echo?</h1>
          <p>Small class sizes, handcrafted instruments, a strong community.</p>
          <ul class="checklist body-text">
            <li>Small class sizes.</li>
            <li>Handmade instruments.</li>
            <li>A strong community.</li>
            <li>Discover what sets us apart.</li>
          </ul>
        </div>
      </div>
    </section>

    <blockquote class="testimonial">
      “My son’s confidence has grown so much since joining Artisan Echo. He loves his lessons!”<cite>— Luca D</cite>
      <img loading="lazy" src="https://xsgames.co/randomusers/avatar.php?g=male" alt="User Avatar" class="user-avatar" />
    </blockquote>

    <section class="newsletter container">
      <div class="grid-fit">
        <div>
          <h2>Subscribe to newsletter</h2>
          <p class="body-text">Join our mailing list for class updates, workshops, and special offers.</p>

          <?php if (!empty($newsError)): ?>
          <div class="form-msg error"><?= htmlspecialchars($newsError) ?></div>
          <?php endif; ?>
          <?php if (!empty($newsSuccess)): ?>
          <div class="form-msg success"><?= htmlspecialchars($newsSuccess) ?></div>
          <?php endif; ?>

          <form id="newsletterForm" class="form-inline" method="POST" novalidate>
            <label for="newsEmail" class="sr-only">Email</label>
            <input id="newsEmail" name="newsletter_email" type="email" placeholder="you@example.com" required />
            <button class="btn" type="submit">Subscribe</button>
          </form>
        </div>
        <figure class="promo-media">
          <img loading="lazy" src="assets/img/newsletter.jpg" alt="Workshop photo" />
        </figure>
      </div>
    </section>

    <section class="cta container">
      <div class="cta-bar">
        <h2 class="action-title">Ready to start your musical journey?</h2>
        <div class="cta-buttons">
          <a class="btn btn-primary" href="contact.php#trial">Book a Free Trial Lesson</a>
          <a class="btn" href="contact.php">Contact us</a>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>

</html>