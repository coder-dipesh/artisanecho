<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Courses | Artisan Echo</title>
  <link rel="stylesheet" href="css/base.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'includes/header.php'; ?>

  <main id="main">
    <section class="hero hero-banner">
      <div class="container hero-inner">
        <h1>Our Music Courses</h1>
        <p class="body-text">Whether you're a beginner or a seasoned player, we have a course for you.</p>
      </div>
    </section>

    <!-- Filters -->
    <section class="filters container">
      <div class="filter-row">
        <label>
          Instrument
          <select class="select" id="fInstrument">
            <option value="all">All</option>
            <option value="Guitar">Guitar</option>
            <option value="Piano">Piano</option>
            <option value="Voice">Voice</option>
            <option value="Drums">Drums</option>
          </select>
        </label>
        <label>
          Level
          <select class="select" id="fLevel">
            <option value="any">Any</option>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
          </select>
        </label>
        <label>
          Age Group
          <select class="select" id="fAge">
            <option value="any">Any</option>
            <option value="kids">Kids</option>
            <option value="teens">Teens</option>
            <option value="adults">Adults</option>
          </select>
        </label>
      </div>
    </section>

    <!-- Dynamic Courses Grid -->
    <section class="container">
      <ul id="courseList" class="card-grid course-grid"></ul>
    </section>

    <section class="cta container">
      <div class="cta-bar">
        <p class="action-title">Ready to start your musical journey?</p>
        <p>
          <a class="btn btn-primary" href="contact.php#trial">Book a Free Trial Lesson</a>
          <a class="btn" href="contact.php">Contact us</a>
        </p>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="courseModal" role="dialog" aria-modal="true" aria-labelledby="courseTitle" hidden>
      <div class="modal-content">
        <button class="modal-close" aria-label="Close">×</button>
        <h3 id="courseTitle">Course title</h3>
        <div id="courseDesc">Course description goes here.</div>
        <div id="courseActions" class="modal-actions"></div>
      </div>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="js/courses.js"></script>
</body>

</html>