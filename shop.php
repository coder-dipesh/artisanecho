<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shop | Artisan Echo</title>
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon_io/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon_io/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon_io/favicon-16x16.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/base.css" />

</head>

<body>
  <?php include 'includes/header.php'; ?>

  <main id="main">
    <section class="hero hero-banner">
      <div class="container hero-inner">
        <h1>Shop Instruments</h1>
        <p class="body-text">Browse our collection of handcrafted instruments and accessories.</p>
      </div>
    </section>

    <section class="filters container">
      <div class="filter-row">
        <form id="filterForm" class="form-inline">
          <div>

            <label for="type">Instrument Type</label>
            <select name="type" id="type">
              <option value="all">All</option>
              <option value="Percussion">Percussion</option>
              <option value="String">String</option>
              <option value="Wind">Wind</option>
              <option value="Accessory">Accessory</option>
            </select>
          </div>

          <div>

            <label for="price">Price Range</label>
            <select name="price" id="price">
              <option value="any">Any</option>
              <option value="0-100">Under $100</option>
              <option value="100-300">$100 – $300</option>
              <option value="300-600">$300 – $600</option>
              <option value="600-1000">$600 – $1000</option>
            </select>
          </div>

          <div>

            <label for="sort">Sort By</label>
            <select name="sort" id="sort">
              <option value="newest">Newest</option>
              <option value="price_asc">Price: Low to High</option>
              <option value="price_desc">Price: High to Low</option>
              <option value="name_asc">Name: A → Z</option>
              <option value="name_desc">Name: Z → A</option>
            </select>
          </div>
        </form>
      </div>

    </section>

    <section class="container">
      <ul id="productList" class="card-grid"></ul>
    </section>


    <section class="container makers">
      <div>
        <h1 class="action-title">Meet a maker</h1>
        <h2 class="body-text">
          Discover the stories behind the instruments — from garage workshops to festival stages.
        </h2>
      </div>

      <figure class="video-placeholder" role="img" aria-label="Video about a maker">
        <video autoplay muted loop playsinline width="100%" preload="metadata" poster="./assets/img/banner.png">
          <source src="./assets/video/meet.mp4" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </figure>
    </section>

    <section class="cta container">
      <div class="cta-bar">
        <p class="action-title">Want to try before you buy?</p>
        <div class="cta-buttons">
          <a class="btn btn-primary" href="contact.html">Book a visit to our studio</a>
          <a class="btn" href="contact.html">Contact us</a>
        </div>
      </div>
    </section>


  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="js/shop.js"></script>
</body>

</html>