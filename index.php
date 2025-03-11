<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pakistan Properties and Builders - Home</title>
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/blog.css">
  <!-- <link rel="stylesheet" href="animation.css" /> -->
</head>

<body>
  <div class="preloader">
    <div class="loader-container">
      <div class="loader"></div>
      <img loading="lazy" src="media/logoFinal.png" alt="Company Logo">
    </div>
  </div>
  <a href="tel:03216817568" target="_blank" rel="noopener noreferrer" class="sticky-cta"><i class="bx bx-phone"></i></a>
  <?php include 'navbar.php'; ?>


  <div class="land animate-on-scroll">
    <div class="land1">
      <h1>Your Dream House Awaits with Us</h1>
      <p>
        Discover a seamless journey to your dream home with Pakistan
        Properties and Builders. Featuring a CTA to view properties or get a
        consultation.
      </p>
      <a href="contact.php" class="btn">Contact Us</a>
    </div>
    <div class="land2"></div>
  </div>
  <!-- Featured Listings -->
  <section class="featured-listings animate-on-scroll">
    <h2>Featured Properties</h2>
    <div class="listings-grid">
      <div class="listing-card">
        <div class="image-container">
          <img loading="lazy" src="media/lahore.webp" alt="Lahore">
        </div>
        <div class="card-content">
          <h3>Lahore</h3>
          <a href="projects.php?city=Lahore" class="view-details">View Details</a>
        </div>
      </div>
      <div class="listing-card">
        <div class="image-container">
          <img loading="lazy" src="media/Islamabad.webp" alt="Islamabad">
        </div>
        <div class="card-content">
          <h3>Islamabad</h3>
          <a href="projects.php?city=Islamabad" class="view-details">View Details</a>
        </div>
      </div>
      <div class="listing-card">
        <div class="image-container">
          <img loading="lazy" src="media/Sialkot.webp" alt="Sialkot">
        </div>
        <div class="card-content">
          <h3>Sialkot</h3>
          <a href="projects.php?city=Sialkot" class="view-details">View Details</a>
        </div>
      </div>
    </div>
  </section>

  <!-- About Us -->
  <section class="about-us animate-on-scroll">
    <h2 class="autoShow">About Us</h2>
    <p class="autoShow">
      We are a passionate team dedicated to creating innovative solutions that make a difference.
      With years of experience and a commitment to excellence, we strive to deliver quality and
      value in everything we do. Our mission is to empower our community, inspire creativity,
      and build a brighter future together.
    </p>
    <a href="about.php" class="btn autoShow">Learn More</a>
  </section>

  <!-- CEO Vision -->
  <section class="ceo-vision animate-on-scroll">
    <h2>CEO's Vision</h2>
    <div class="vision-content autoShow2">
      <div class="vision-text">
        <h3>CEO’s Message – Pakistan Properties & Builders</h3>
        <p class="staggered">
          "Real estate is about smart decisions. At Pakistan Properties &
        </p>
        <p class="staggered">
          Builders, we guide our clients to the best investments in DHA
        </p>
        <p class="staggered">
          Lahore, Bahria Town, Lahore Smart City, Capital Smart City, DHA
        </p>
        <p class="staggered">
          Islamabad Phase 9, and DHA Gandhara. Since 2018, we’ve prioritized
        </p>
        <p class="staggered">
          trust, transparency, and value, ensuring you stay ahead in an
        </p>
        <p class="staggered">
          evolving market. Whether it’s a home, commercial space, or
        </p>
        <p class="staggered">
          investment, we’re here to make your real estate journey smooth,
        </p>
        <p class="staggered">
          secure, and rewarding—for local and overseas clients alike."
        </p>
      </div>
      <div class="vision-media">
        <iframe
          width="560"
          height="315"
          src="https://www.youtube.com/embed/BoP630-6gkU?si=KFwiu8OO2L4AXe0R"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin"
          allowfullscreen></iframe>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <div class="testimonial-container animate-on-scroll">
    <div class="slides">
      <div class="slide active">
        <p>"This is the best real estate service I have ever used. Professional and quick!"</p>
        <h3>- Aisha Khan</h3>
      </div>
      <div class="slide">
        <p>"I found my dream home thanks to Pakistan Properties and Builders!"</p>
        <h3>- Ahmed Raza</h3>
      </div>
      <div class="slide">
        <p>"Their consultation services helped me make the best investment decision!"</p>
        <h3>- Fatima Malik</h3>
      </div>
      <div class="slide">
        <p>"Quick, reliable, and trustworthy. Highly recommended!"</p>
        <h3>- Hassan Javed</h3>
      </div>
    </div>

    <button class="prev"><i class='bx bx-chevron-left'></i></button>
    <button class="next"><i class='bx bx-chevron-right'></i></button>

    <div class="nav-dots">
      <span class="nav-dot active"></span>
      <span class="nav-dot"></span>
      <span class="nav-dot"></span>
      <span class="nav-dot"></span>
    </div>
  </div>

  <!-- Blog/News -->
  <section class="blog animate-on-scroll">
    <h2>Latest News & Tips</h2>
    <div class="blog-grid">
      <?php
      include 'db_connect.php'; // Include database connection
      $sql = "SELECT * FROM blog_posts ORDER BY RAND() LIMIT 2"; // Fetch 2 random blog posts
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($blog = $result->fetch_assoc()) {
          $image = !empty($blog['featured_image']) ? htmlspecialchars($blog['featured_image']) : 'media/blog.jpg'; // Fallback image
          echo '<div class="blog-card">';
          echo '<img loading="lazy" src="' . $image . '" alt="' . htmlspecialchars($blog['title']) . '" />';
          echo '<h3>' . htmlspecialchars($blog['title']) . '</h3>';
          echo '<a href="blog.php" class="btn">Read More</a>';
          echo '</div>';
        }
      } else {
        // Fallback if no blog posts are found
        echo '<div class="blog-card">';
        echo '<img src="media/blog.jpg" alt="Placeholder" />';
        echo '<h3>No Blog Posts Available</h3>';
        echo '<a href="blog.php" class="btn">Read More</a>';
        echo '</div>';
        echo '<div class="blog-card">';
        echo '<img loading="lazy" src="media/blog.jpg" alt="Placeholder" />';
        echo '<h3>Check Back Soon!</h3>';
        echo '<a href="blog.php" class="btn">Read More</a>';
        echo '</div>';
      }
      $conn->close();
      ?>
    </div>
  </section>
  <?php include 'footer.php'; ?>

  <script type="module" src="js/main.js"></script>
</body>

</html>