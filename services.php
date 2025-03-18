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
  <title>Pakistan Properties and Builder - Services</title>
  <link rel="icon" type="image/x-icon" href="media/favicon.ico">
  <meta name="description" content="Pakistan Properties and Builders offers property sales, investment consultation, and property management services.">
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