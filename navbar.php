<?php
// Get the current URL
$protocol = 'http://';  // Use HTTP for local development
$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];

// Remove www if present
$host = preg_replace('/^www\./i', '', $host);

// Clean the URI
$uri = strtok($uri, '?'); // Remove query parameters
$uri = rtrim($uri, '/'); // Remove trailing slash

// Special case for homepage
if ($uri == '' || $uri == '/index.php') {
    $uri = '/';
}

// Construct canonical URL
$canonicalUrl = $protocol . $host . $uri;
?>
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>" />
<meta name="robots" content="index, follow">
<nav>
  <div class="navbar">
    <i class="bx bx-menu sidebarOpen"></i>
    <div class="brand-container">
      <a href="index.php">
        <div class="logo">
          <img src="media/logoFinal.png" alt="Company Logo" />
        </div>
        <div class="company-name">
          <h2 id="pk">PAKISTAN</h2>
          <p id="pAndB">Properties and Builders</p>
          <p id="sologan">The Sign of Experience</p>
        </div>
      </a>
    </div>
    <div class="nav-links">
      <div class="logo-toggle">
        <div class="logo">
          <img src="media/logoFinal.png" alt="Pakistan Properties and Builders Logo" />
        </div>
        <div class="company-name">
          <h2>PAKISTAN</h2>
          <p>Properties and Builders</p>
        </div>
        <i class="bx bx-x sidebarClose"></i>
      </div>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="projects.php">Projects</a></li>
        <li><a href="blog.php">Blogs</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div class="social-icons">
      <a
        class="whatsapp"
        href="https://wa.me/923216817568"
        target="_blank"
        rel="noopener noreferrer"><i class="bx bxl-whatsapp"></i></a>
      <a
        class="insta"
        href="https://www.instagram.com/pakistanpropertiesandbuilders/"
        target="_blank"
        rel="noopener noreferrer"><i class="bx bxl-instagram"></i></a>
      <a
        class="phone"
        href="tel:03216817568"
        target="_blank"
        rel="noopener noreferrer"><i class="bx bx-phone"></i></a>
      <a
        class="mail"
        href="mailto:info@pakistanpropertiesandbuilders.com"
        target="_blank"
        rel="noopener noreferrer"><i class="bx bx-envelope"></i></a>
    </div>
  </div>
</nav>