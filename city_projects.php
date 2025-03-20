<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    include 'db_connect.php';
    $city = isset($_GET['city']) ? $_GET['city'] : 'Lahore';
    $sql = "SELECT id, title, details FROM projects WHERE city = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $city);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch first image for OG and Twitter tags
    $sql_img = "SELECT image_path FROM project_images WHERE project_id = (SELECT id FROM projects WHERE city = ? LIMIT 1) LIMIT 1";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bind_param("s", $city);
    $stmt_img->execute();
    $img = $stmt_img->get_result()->fetch_assoc();
    $stmt_img->close();
    $project_image_url = $img['image_path'] ?? 'https://www.pakistanpropertiesandbuilders.com/media/default.jpg';
    ?>
    <meta name="description" content="Explore top real estate projects in <?php echo htmlspecialchars($city); ?> - investment opportunities, residential and commercial properties by Pakistan Properties and Builders." />
    <meta name="keywords" content="real estate projects, <?php echo htmlspecialchars($city); ?>, Pakistan Properties, investment, residential properties, commercial properties" />
    <!-- Open Graph tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($city); ?> Real Estate Projects" />
    <meta property="og:description" content="Explore top real estate projects in <?php echo htmlspecialchars($city); ?> - investment opportunities, residential and commercial properties by Pakistan Properties and Builders." />
    <meta property="og:image" content="<?php echo htmlspecialchars($project_image_url); ?>" />
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/city_projects.php?city=<?php echo urlencode($city); ?>" />
    <meta property="og:type" content="website" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo htmlspecialchars($city); ?> Real Estate Projects" />
    <meta name="twitter:description" content="Explore top real estate projects in <?php echo htmlspecialchars($city); ?> - investment opportunities, residential and commercial properties by Pakistan Properties and Builders." />
    <meta name="twitter:image" content="<?php echo htmlspecialchars($project_image_url); ?>" />
    <title><?php echo htmlspecialchars($city); ?> Projects</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.ico" />
    <link rel="sitemap" type="application/xml" href="https://www.pakistanpropertiesandbuilders.com/sitemap.xml" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/city_projects.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" />
    <link rel="canonical" href="https://www.pakistanpropertiesandbuilders.com/city_projects.php?city=<?php echo urlencode($city); ?>" />
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            <?php
            $counter = 1;
            $result->data_seek(0);
            while ($project = $result->fetch_assoc()):
                $sql_img = "SELECT image_path FROM project_images WHERE project_id = ? LIMIT 1";
                $stmt_img = $conn->prepare($sql_img);
                $stmt_img->bind_param("i", $project['id']);
                $stmt_img->execute();
                $img = $stmt_img->get_result()->fetch_assoc();
                $stmt_img->close();
                echo ($counter > 1 ? ',' : '') . '{
                    "@type": "ListItem",
                    "position": ' . $counter++ . ',
                    "item": {
                        "@type": "RealEstateListing",
                        "name": "' . htmlspecialchars($project['title']) . '",
                        "description": "' . htmlspecialchars($project['details']) . '",
                        "image": "' . htmlspecialchars($img['image_path'] ?? 'default.jpg') . '",
                        "url": "https://www.pakistanpropertiesandbuilders.com/details.php?id=' . $project['id'] . '"
                    }
                }';
            endwhile;
            $result->data_seek(0);
            ?>
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://www.pakistanpropertiesandbuilders.com/" },
            { "@type": "ListItem", "position": 2, "name": "Projects", "item": "https://www.pakistanpropertiesandbuilders.com/projects.php" },
            { "@type": "ListItem", "position": 3, "name": "<?php echo htmlspecialchars($city); ?> Projects", "item": "https://www.pakistanpropertiesandbuilders.com/city_projects.php?city=<?php echo urlencode($city); ?>" }
        ]
    }
    </script>
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
</head>
<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT8KVRFM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php include 'navbar.php'; ?>
    <div class="main-content">
        <h1><?php echo htmlspecialchars($city); ?> Real Estate Projects</h1>
        <section class="projects-grid">
            <?php while ($project = $result->fetch_assoc()): ?>
                <div class="project-card animate-on-scroll">
                    <?php
                    $sql_img = "SELECT image_path FROM project_images WHERE project_id = ? LIMIT 1";
                    $stmt_img = $conn->prepare($sql_img);
                    $stmt_img->bind_param("i", $project['id']);
                    $stmt_img->execute();
                    $img = $stmt_img->get_result()->fetch_assoc();
                    $stmt_img->close();
                    ?>
                    <img src="<?php echo htmlspecialchars($img['image_path'] ?? 'media/project-placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($project['title']); ?> in <?php echo htmlspecialchars($city); ?>" loading="lazy" />
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><?php echo htmlspecialchars($project['details']); ?></p>
                    <a href="details.php?id=<?php echo $project['id']; ?>" class="btn">Learn More</a>
                </div>
            <?php
            endwhile;
            $stmt->close();
            ?>
        </section>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>