<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gallery | Artisan Echo</title>
  <link rel="stylesheet" href="css/base.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'includes/header.php'; ?>

  <main id="main">
    <section class="hero hero-banner">
      <div class="container hero-inner">
        <h1>Our Gallery</h1>
        <p class="body-text">A glimpse into the sounds, faces, and moments that shape Artisan Echo.</p>
      </div>
    </section>

    <!-- Category filters -->
    <section class="filters container">
      <div class="chip-row" role="tablist" aria-label="Gallery filters">
        <button class="chip active" data-filter="all">All</button>
        <button class="chip" data-filter="classes">Classes</button>
        <button class="chip" data-filter="events">Events</button>
        <button class="chip" data-filter="instruments">Instruments</button>
        <button class="chip" data-filter="performances">Performances</button>
      </div>
    </section>

    <!-- Gallery grid -->
    <section class="container gallery-grid" id="galleryGrid">
      <?php
      $stmt = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC");
      $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($images) {
        foreach ($images as $img) {
          echo "<a href='" . htmlspecialchars($img['image_url']) . "' 
                  class='gallery-item' 
                  data-cat='" . htmlspecialchars($img['category']) . "' 
                  data-caption='" . htmlspecialchars($img['caption']) . "'>";
          echo "  <img loading='lazy' src='" . htmlspecialchars($img['image_url']) . "' alt='" . htmlspecialchars($img['title']) . "' />";
          echo "</a>";
        }
      } else {
        echo "<p>No gallery images yet.</p>";
      }
      ?>
    </section>

    <section class="cta container">
      <div class="cta-bar">
        <div>
          <p><strong>Want to be featured in our gallery?</strong></p>
          <p class="small">Join a class or event — we love celebrating our community!</p>
        </div>
        <p>
          <a class="btn btn-primary" href="courses.php">Explore Courses</a>
          <a class="btn" href="contact.php">See Events</a>
        </p>
      </div>
    </section>

    <!-- Lightbox modal -->
    <div id="lightbox" class="lightbox" role="dialog" aria-modal="true" aria-label="Image preview" hidden>
      <button class="lightbox-close" aria-label="Close">×</button>
      <figure>
        <img loading="lazy" id="lightboxImg" alt="" />
        <figcaption id="lightboxCap"></figcaption>
      </figure>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="js/gallery.js"></script>
</body>

</html>