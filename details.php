<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    include 'db_connect.php';
    $project_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $project = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $title = $project ? $project['title'] : 'Project Not Found';
    // Fetch first image for OG and Twitter tags
    $sql_img = "SELECT image_path FROM project_images WHERE project_id = ? LIMIT 1";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bind_param("i", $project_id);
    $stmt_img->execute();
    $img = $stmt_img->get_result()->fetch_assoc();
    $stmt_img->close();
    $project_image_url = $img['image_path'] ?? 'https://www.pakistanpropertiesandbuilders.com/media/default.jpg';
    function sanitize_youtube_url($url) {
        $url = trim($url);
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $match)) {
            $video_id = $match[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $match)) {
            $video_id = $match[1];
        } else {
            return $url;
        }
        return "https://www.youtube.com/embed/" . $video_id . "?enablejsapi=1&rel=0";
    }
    ?>
    <title><?php echo htmlspecialchars($title); ?> | Pakistan Properties and Builders</title>
    <meta name="description" content="<?php echo htmlspecialchars($project['description'] ?? 'Explore this premium real estate project by Pakistan Properties and Builders.'); ?> Explore pricing, location, and amenities." />
    <meta name="keywords" content="real estate project, <?php echo htmlspecialchars($title); ?>, Pakistan Properties, pricing, location, amenities" />
    <link rel="canonical" href="https://www.pakistanpropertiesandbuilders.com/details.php?id=<?php echo $project_id; ?>" />
    <link rel="sitemap" type="application/xml" href="https://www.pakistanpropertiesandbuilders.com/sitemap.xml" />
    <link rel="icon" type="image/x-icon" href="media/favicon.ico" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/details.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" />
    <!-- Open Graph tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?> | Pakistan Properties and Builders" />
    <meta property="og:description" content="<?php echo strlen($project['description']) > 160 ? substr(htmlspecialchars($project['description']), 0, 157) . '...' : htmlspecialchars($project['description']); ?>" />
    <meta property="og:image" content="<?php echo htmlspecialchars($project_image_url); ?>" />
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/details.php?id=<?php echo $project_id; ?>" />
    <meta property="og:type" content="website" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?> | Pakistan Properties and Builders" />
    <meta name="twitter:description" content="<?php echo strlen($project['description']) > 160 ? substr(htmlspecialchars($project['description']), 0, 157) . '...' : htmlspecialchars($project['description']); ?>" />
    <meta name="twitter:image" content="<?php echo htmlspecialchars($project_image_url); ?>" />
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "RealEstateListing",
        "name": "<?php echo htmlspecialchars($title); ?>",
        "description": "<?php echo htmlspecialchars($project['description']); ?>",
        "url": "https://www.pakistanpropertiesandbuilders.com/details.php?id=<?php echo $project_id; ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "<?php echo htmlspecialchars($project['location']); ?>",
            "addressCountry": "PK"
        },
        "offers": {
            "@type": "Offer",
            "priceCurrency": "PKR",
            "availabilityStarts": "<?php echo date('Y-m-d'); ?>"
        },
        "image": "<?php echo htmlspecialchars($project_image_url); ?>",
        "provider": {
            "@type": "Organization",
            "name": "Pakistan Properties and Builders",
            "url": "https://www.pakistanpropertiesandbuilders.com/"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://www.pakistanpropertiesandbuilders.com/" },
            { "@type": "ListItem", "position": 2, "name": "Projects", "item": "https://www.pakistanpropertiesandbuilders.com/projects.php" },
            { "@type": "ListItem", "position": 3, "name": "<?php echo htmlspecialchars($title); ?>", "item": "https://www.pakistanpropertiesandbuilders.com/details.php?id=<?php echo $project_id; ?>" }
        ]
    }
    </script>
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
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT8KVRFM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php include 'navbar.php'; ?>
    <div class="main-content">
        <?php if ($project): ?>
            <div class="two-column-layout">
                <div class="left-column">
                    <h1><?php echo htmlspecialchars($project['title']); ?></h1>
                    <p><?php echo htmlspecialchars($project['details']); ?></p>
                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                </div>
                <div class="right-column">
                    <section class="gallery animate-on-scroll">
                        <h2>Project Gallery</h2>
                        <div class="carousel-container">
                            <?php
                            $sql = "SELECT image_path FROM project_images WHERE project_id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $project_id);
                            $stmt->execute();
                            $images = $stmt->get_result();
                            $index = 0;
                            while ($image = $images->fetch_assoc()) {
                                $activeClass = $index === 0 ? 'active' : '';
                                echo '<img src="' . htmlspecialchars($image['image_path']) . '" alt="Project Image" class="carousel-image ' . $activeClass . '">';
                                $index++;
                            }
                            $stmt->close();
                            ?>
                            <button class="carousel-prev">‹</button>
                            <button class="carousel-next">›</button>
                        </div>
                        <div class="carousel-thumbnails">
                            <?php
                            $sql = "SELECT image_path FROM project_images WHERE project_id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $project_id);
                            $stmt->execute();
                            $images = $stmt->get_result();
                            $index = 0;
                            while ($image = $images->fetch_assoc()) {
                                $activeClass = $index === 0 ? 'active' : '';
                                echo '<img src="' . htmlspecialchars($image['image_path']) . '" alt="Thumbnail" class="thumbnail ' . $activeClass . '" data-index="' . $index . '">';
                                $index++;
                            }
                            $stmt->close();
                            ?>
                        </div>
                    </section>
                </div>
            </div>
            <?php if ($project['video_url']): ?>
                <section class="video-tour animate-on-scroll">
                    <h2>Virtual Tour</h2>
                    <iframe src="<?php echo htmlspecialchars(sanitize_youtube_url($project['video_url'])); ?>" allowfullscreen></iframe>
                </section>
            <?php endif; ?>
            <section class="amenities animate-on-scroll">
                <h2>Key Amenities</h2>
                <ul class="amenities-list">
                    <?php
                    $amenities = json_decode($project['amenities'], true);
                    foreach ($amenities as $amenity) {
                        echo '<li>' . htmlspecialchars($amenity) . '</li>';
                    }
                    ?>
                </ul>
            </section>
            <section class="pricing animate-on-scroll">
                <h2>Pre-Booking Prices</h2>
                <table>
                    <tr>
                        <th>Plot Size</th>
                        <th>Price (PKR)</th>
                        <th>Payment Plan</th>
                    </tr>
                    <?php
                    $sql = "SELECT plot_size, price, payment_plan FROM project_pricing WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $pricing = $stmt->get_result();
                    while ($price = $pricing->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($price['plot_size']) . "</td>
                            <td>" . htmlspecialchars($price['price']) . "</td>
                            <td>" . htmlspecialchars($price['payment_plan']) . "</td>
                        </tr>";
                    }
                    $stmt->close();
                    ?>
                </table>
            </section>
            <section class="location-map animate-on-scroll">
                <h2>Location</h2>
                <p><?php echo htmlspecialchars($project['location']); ?></p>
                <?php if ($project['map_url']): ?>
                    <iframe src="<?php echo htmlspecialchars($project['map_url']); ?>" allowfullscreen loading="lazy"></iframe>
                <?php endif; ?>
            </section>
            <?php if ($project['developers']): ?>
                <section class="developers animate-on-scroll">
                    <h2>Meet the Developers</h2>
                    <p><?php echo htmlspecialchars($project['developers']); ?></p>
                </section>
            <?php endif; ?>
            <?php if ($project['testimonials']): ?>
                <section class="testimonials animate-on-scroll">
                    <h2>What Our Clients Say</h2>
                    <?php
                    $testimonials = json_decode($project['testimonials'], true);
                    foreach ($testimonials as $testimonial) {
                        echo '<blockquote><p>' . htmlspecialchars($testimonial) . '</p></blockquote>';
                    }
                    ?>
                </section>
            <?php endif; ?>
            <a href="contact.php" class="btn">Contact Us</a>
        <?php else: ?>
            <h1>Project Not Found</h1>
            <p>Sorry, the project you’re looking for doesn’t exist.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
    <script type="module" src="js/main.js"></script>
</body>
</html>