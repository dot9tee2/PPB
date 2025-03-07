<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/services.css">
  <title>Services</title>
</head>

<body>
  <div class="preloader">
    <div class="loader-container">
      <div class="loader"></div>
      <img src="media/logoFinal.png" alt="Company Logo">
    </div>
  </div>
  <?php include 'navbar.php'; ?>

  <section class="services">
    <h2>Our Services</h2>
    <div class="services-grid">
      <div class="service-card">
        <h3>Property Sales</h3>
        <p>
          Find your dream home or investment property in top locations like
          DHA Lahore and Bahria Town.
        </p>
      </div>
      <div class="service-card">
        <h3>Investment Consultation</h3>
        <p>
          Get expert advice on real estate opportunities in Pakistan’s growing
          markets.
        </p>
      </div>
      <div class="service-card">
        <h3>Property Management</h3>
        <p>Let us handle your property needs, from rentals to maintenance.</p>
      </div>
    </div>
    <a href="contact.php" class="btn">Contact Us for More Info</a>
  </section>

  <?php include 'footer.php'; ?>
  <script type="module" src="js/main.js"></script>
</body>

</html>