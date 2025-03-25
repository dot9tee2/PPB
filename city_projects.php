<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    include 'db_connect.php';
    $city = isset($_GET['location']) ? $_GET['location'] : (isset($_GET['city']) ? $_GET['city'] : 'Lahore');
    $project = isset($_GET['project']) ? $_GET['project'] : '';
    
    // SQL query with conditional filtering
    if (!empty($project)) {
        $sql = "SELECT id, title, details FROM projects WHERE city = ? AND title LIKE ?";
        $project_param = '%' . $project . '%';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $city, $project_param);
    } else {
        $sql = "SELECT id, title, details FROM projects WHERE city = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $city);
    }
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
    
    // Page title and meta description setup
    $page_title = htmlspecialchars($city);
    $meta_description = "Explore top real estate projects in " . htmlspecialchars($city);
    
    if (!empty($project)) {
        $page_title .= " - " . htmlspecialchars($project);
        $meta_description .= " - " . htmlspecialchars($project) . " projects and investment opportunities by Pakistan Properties and Builders.";
    } else {
        $meta_description .= " - investment opportunities, residential and commercial properties by Pakistan Properties and Builders.";
    }
    ?>
    <meta name="description" content="<?php echo $meta_description; ?>" />
    <meta name="keywords" content="real estate projects, <?php echo htmlspecialchars($city); ?>, <?php echo !empty($project) ? htmlspecialchars($project) . ',' : ''; ?> Pakistan Properties, investment, residential properties, commercial properties" />
    <!-- Open Graph tags -->
    <meta property="og:title" content="<?php echo $page_title; ?> Real Estate Projects" />
    <meta property="og:description" content="<?php echo $meta_description; ?>" />
    <meta property="og:image" content="<?php echo htmlspecialchars($project_image_url); ?>" />
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/city_projects.php?city=<?php echo urlencode($city); ?><?php echo !empty($project) ? '&project=' . urlencode($project) : ''; ?>" />
    <meta property="og:type" content="website" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $page_title; ?> Real Estate Projects" />
    <meta name="twitter:description" content="<?php echo $meta_description; ?>" />
    <meta name="twitter:image" content="<?php echo htmlspecialchars($project_image_url); ?>" />
    <title><?php echo $page_title; ?> Projects</title>
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
            while ($project_item = $result->fetch_assoc()):
                $sql_img = "SELECT image_path FROM project_images WHERE project_id = ? LIMIT 1";
                $stmt_img = $conn->prepare($sql_img);
                $stmt_img->bind_param("i", $project_item['id']);
                $stmt_img->execute();
                $img = $stmt_img->get_result()->fetch_assoc();
                $stmt_img->close();
                echo ($counter > 1 ? ',' : '') . '{
                    "@type": "ListItem",
                    "position": ' . $counter++ . ',
                    "item": {
                        "@type": "RealEstateListing",
                        "name": "' . htmlspecialchars($project_item['title']) . '",
                        "description": "' . htmlspecialchars($project_item['details']) . '",
                        "image": "' . htmlspecialchars($img['image_path'] ?? 'default.jpg') . '",
                        "url": "https://www.pakistanpropertiesandbuilders.com/details.php?id=' . $project_item['id'] . '"
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
            { "@type": "ListItem", "position": 3, "name": "<?php echo htmlspecialchars($city); ?> Projects", "item": "https://www.pakistanpropertiesandbuilders.com/city_projects.php?city=<?php echo urlencode($city); ?>" }<?php 
            if (!empty($project)) {
                echo ',
            { "@type": "ListItem", "position": 4, "name": "' . htmlspecialchars($project) . '", "item": "https://www.pakistanpropertiesandbuilders.com/city_projects.php?city=' . urlencode($city) . '&project=' . urlencode($project) . '" }';
            }
            ?>
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
        <h1><?php echo $page_title; ?> Real Estate Projects</h1>
        
        <?php if ($result->num_rows == 0): ?>
        <div class="no-results">
            <p>No projects found for <?php echo htmlspecialchars($city); ?><?php echo !empty($project) ? ' in ' . htmlspecialchars($project) : ''; ?>.</p>
            <a href="projects.php" class="btn">View All Projects</a>
        </div>
        <?php else: ?>
        <section class="projects-grid">
            <?php while ($project_item = $result->fetch_assoc()): ?>
                <div class="project-card animate-on-scroll">
                    <?php
                    $sql_img = "SELECT image_path FROM project_images WHERE project_id = ? LIMIT 1";
                    $stmt_img = $conn->prepare($sql_img);
                    $stmt_img->bind_param("i", $project_item['id']);
                    $stmt_img->execute();
                    $img = $stmt_img->get_result()->fetch_assoc();
                    $stmt_img->close();
                    ?>
                    <img src="<?php echo htmlspecialchars($img['image_path'] ?? 'media/project-placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($project_item['title']); ?> in <?php echo htmlspecialchars($city); ?>" loading="lazy" />
                    <h3><?php echo htmlspecialchars($project_item['title']); ?></h3>
                    <p><?php echo htmlspecialchars($project_item['details']); ?></p>
                    <a href="details.php?id=<?php echo $project_item['id']; ?>" class="btn">Learn More</a>
                </div>
            <?php
            endwhile;
            $stmt->close();
            ?>
        </section>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>