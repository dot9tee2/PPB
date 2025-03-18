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
  <meta name="description" content="Get in touch with Pakistan Properties and Builders for expert advice on buying, selling, and investing in properties.">
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Pakistan Properties and Builders",
      "image": "https://www.pakistanpropertiesandbuilders.com/logo.png",
      "url": "https://www.pakistanpropertiesandbuilders.com/",
      "telephone": "+92-321-6817568",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Commercial Broadway, DHA Phase 8",
        "addressLocality": "Lahore",
        "postalCode": "54940",
        "addressCountry": "PK"
      },
      "description": "Leading real estate and construction company in Lahore offering property deals, home construction, and consultation services.",
      "openingHours": "Mo-Sa 09:00-18:00",
      "priceRange": "$$"
    }
  </script>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-KT8KVRFM');
  </script>
  <!-- End Google Tag Manager -->

</head>

<body>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT8KVRFM"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
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