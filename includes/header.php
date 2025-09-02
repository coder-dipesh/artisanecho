<header class="site-header" role="banner">
  <div class="container header-inner">
    <a class="logo" href="index.php" aria-label="Artisan Echo Home">
      <span class="logo-text">Artisan Echo</span>
    </a>
    <button class="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="site-nav">☰</button>
    <nav id="site-nav" class="site-nav" aria-label="Primary">
      <ul>
        <li><a class="<?= basename($_SERVER['PHP_SELF'])=='index.php'?'active':'' ?>" href="index.php">Home</a></li>
        <li><a class="<?= basename($_SERVER['PHP_SELF'])=='courses.php'?'active':'' ?>" href="courses.php">Courses</a></li>
        <li><a class="<?= basename($_SERVER['PHP_SELF'])=='shop.php'?'active':'' ?>" href="shop.php">Shop</a></li>
        <li><a class="<?= basename($_SERVER['PHP_SELF'])=='gallery.php'?'active':'' ?>" href="gallery.php">Gallery</a></li>
        <li><a class="<?= basename($_SERVER['PHP_SELF'])=='contact.php'?'active':'' ?>" href="contact.php">Contact</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>

        <li><a class="btn-danger" href="logout.php">Logout</a></li>
        <?php else: ?>
        <li><a class="" href=" login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>