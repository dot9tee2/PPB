<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Real Estate Services | Pakistan Properties and Builders</title>
    <meta name="description" content="Pakistan Properties and Builders offers comprehensive real estate services including property sales, investment consultation, and property management in Lahore, Islamabad, and Sialkot." />
    <meta name="keywords" content="real estate services, Pakistan Properties, property sales, investment consultation, property management, Lahore, Islamabad, Sialkot" />
    <!-- Add Open Graph tags -->
    <meta property="og:title" content="Real Estate Services | Pakistan Properties and Builders" />
    <meta property="og:description" content="Get expert real estate services including property sales, investment consultation, and property management in Pakistan." />
    <meta property="og:image" content="https://www.pakistanpropertiesandbuilders.com/media/logoFinal.png" />
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/services.php" />
    <meta property="og:type" content="website" />
    <!-- Add Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Real Estate Services | Pakistan Properties and Builders" />
    <meta name="twitter:description" content="Get expert real estate services including property sales, investment consultation, and property management in Pakistan." />
    <meta name="twitter:image" content="https://www.pakistanpropertiesandbuilders.com/media/logoFinal.png" />
    <!-- Add canonical URL -->
    <link rel="canonical" href="https://www.pakistanpropertiesandbuilders.com/services.php" />
    <link rel="icon" type="image/x-icon" href="media/favicon.ico" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/services.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" />
    <!-- Enhanced schema markup for services -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "serviceType": "Real Estate Services",
        "provider": {
            "@type": "Organization",
            "name": "Pakistan Properties and Builders",
            "url": "https://www.pakistanpropertiesandbuilders.com/"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Pakistan"
        },
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Real Estate Services",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Property Sales",
                        "description": "Find your dream home or investment property in top locations like DHA Lahore and Bahria Town."
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Investment Consultation",
                        "description": "Get expert advice on real estate opportunities in Pakistan's growing markets."
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Property Management",
                        "description": "Let us handle your property needs, from rentals to maintenance."
                    }
                }
            ]
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://www.pakistanpropertiesandbuilders.com/"},
            {"@type": "ListItem", "position": 2, "name": "Services", "item": "https://www.pakistanpropertiesandbuilders.com/services.php"}
        ]
    }
    </script>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-KT8KVRFM');
    </script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT8KVRFM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="preloader">
        <div class="loader-container">
            <div class="loader"></div>
            <img src="media/logoFinal.png" alt="Company Logo" />
        </div>
    </div>
    <?php include 'navbar.php'; ?>
    <section class="services">
        <h2>Our Services</h2>
        <div class="services-grid">
            <div class="service-card" itemscope itemtype="https://schema.org/Service">
                <h3 itemprop="name">Property Sales</h3>
                <p itemprop="description">
                    Find your dream home or investment property in top locations like
                    DHA Lahore and Bahria Town. We offer residential plots, commercial properties,
                    and ready-to-move homes with transparent pricing and documentation.
                </p>
                <meta itemprop="areaServed" content="Lahore, Islamabad, Sialkot" />
            </div>
            <div class="service-card" itemscope itemtype="https://schema.org/Service">
                <h3 itemprop="name">Investment Consultation</h3>
                <p itemprop="description">
                    Get expert advice on real estate opportunities in Pakistan’s growing
                    markets.
                </p>
                <meta itemprop="areaServed" content="Pakistan" />
            </div>
            <div class="service-card" itemscope itemtype="https://schema.org/Service">
                <h3 itemprop="name">Property Management</h3>
                <p itemprop="description">
                    Let us handle your property needs, from rentals to maintenance.
                </p>
                <meta itemprop="areaServed" content="Pakistan" />
            </div>
        </div>
        <a href="contact.php" class="btn">Contact Us for More Info</a>
    </section>
    <?php include 'footer.php'; ?>
    <script type="module" src="js/main.js"></script>
</body>
</html>