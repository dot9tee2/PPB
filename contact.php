<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="media/favicon.ico">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/contact.css">
  <title>Contact Us - Pakistan Properties</title>
</head>

<body>
  <div class="preloader">
    <div class="loader-container">
      <div class="loader"></div>
      <img src="media/logoFinal.png" alt="Company Logo">
    </div>
  </div>
  <?php include 'navbar.php'; ?>
  <div class="contact">
    <div class="contact-content">
      <h2>Contact Us</h2>
      <form class="contact-form" aria-label="Contact Form">
        <input type="text" placeholder="Your Name" required aria-required="true" />
        <input type="email" placeholder="Your Email" required aria-required="true" />
        <textarea placeholder="Your Message" required aria-required="true"></textarea>
        <button type="submit" aria-label="Send Message">Send Message</button>
      </form>
    </div>
    <div class="contact-details">
      <h2>Reach Out</h2>
      <p><i class="bx bx-phone"></i> 03216817568</p>
      <p><i class="bx bx-envelope"></i> <a href="mailto:info@pakistanproperties.com">info@pakistanproperties.com</a></p>
      <p><i class="bx bx-map"></i> Lahore, Pakistan</p>
      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3402.815!2d74.357158!3d31.520369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39191b4e8e6e3b8b%3A0x5e6f9b5f5e5e5e5!2sDHA%20Lahore!5e0!3m2!1sen!2s!4v1698765432100!5m2!1sen!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </div>


  <?php include 'footer.php'; ?>
  <script type="module" src="js/main.js"></script>
</body>

</html>