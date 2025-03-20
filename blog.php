<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Stay updated with the latest real estate trends and insights. Read our blog for expert advice on buying, selling, and investing in properties." />
    <meta name="keywords" content="real estate blog, property trends, Pakistan Properties, buying tips, selling advice, investment insights" />
    <!-- Open Graph tags -->
    <meta property="og:title" content="Real Estate Insights & News | Pakistan Properties and Builders Blog" />
    <meta property="og:description" content="Stay updated with the latest real estate trends and insights. Read our blog for expert advice on buying, selling, and investing in properties." />
    <meta property="og:image" content="https://www.pakistanpropertiesandbuilders.com/media/blog-cover.jpg" />
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/blog.php" />
    <meta property="og:type" content="website" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Real Estate Insights & News | Pakistan Properties and Builders Blog" />
    <meta name="twitter:description" content="Stay updated with the latest real estate trends and insights. Read our blog for expert advice on buying, selling, and investing in properties." />
    <meta name="twitter:image" content="https://www.pakistanpropertiesandbuilders.com/media/blog-cover.jpg" />
    <title>Real Estate Insights & News | Pakistan Properties and Builders Blog</title>
    <link rel="canonical" href="https://www.pakistanpropertiesandbuilders.com/blog.php" />
    <link rel="icon" type="image/x-icon" href="media/favicon.ico" />
    <link rel="sitemap" type="application/xml" href="https://www.pakistanpropertiesandbuilders.com/sitemap.xml" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/blog.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" />
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
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://www.pakistanpropertiesandbuilders.com/" },
            { "@type": "ListItem", "position": 2, "name": "Blog", "item": "https://www.pakistanpropertiesandbuilders.com/blog.php" }
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "headline": "Real Estate Insights & News | Pakistan Properties and Builders Blog",
        "description": "Stay updated with the latest real estate trends and insights. Read our blog for expert advice on buying, selling, and investing in properties.",
        "publisher": {
            "@type": "Organization",
            "name": "Pakistan Properties and Builders",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.pakistanpropertiesandbuilders.com/logo.png"
            }
        },
        "url": "https://www.pakistanpropertiesandbuilders.com/blog.php",
        "mainEntityOfPage": "https://www.pakistanpropertiesandbuilders.com/blog.php"
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
    <?php include 'navbar.php'; ?>
    <div class="blog-container">
        <div class="blog-main">
            <h1>Real Estate Blog</h1>
            <div class="blog-grid">
                <?php
                include 'db_connect.php';
                $posts_per_page = 6;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $posts_per_page;
                $sql = "SELECT * FROM blog_posts ORDER BY publish_date DESC LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $posts_per_page, $offset);
                $stmt->execute();
                $blogs = $stmt->get_result();
                while ($blog = $blogs->fetch_assoc()):
                ?>
                    <div class="blog-card">
                        <a href="blog-post.php?id=<?php echo $blog['id']; ?>">
                            <?php if ($blog['featured_image']): ?>
                                <img loading="lazy" src="<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" />
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                            <p class="meta">Posted on <?php echo htmlspecialchars($blog['publish_date']); ?></p>
                            <p><?php echo htmlspecialchars(substr($blog['excerpt'], 0, 120) . (strlen($blog['excerpt']) > 120 ? '...' : '')); ?></p>
                        </a>
                        <div>
                            <a href="blog-post.php?id=<?php echo $blog['id']; ?>" class="btn">Read More</a>
                        </div>
                    </div>
                <?php
                endwhile;
                $stmt->close();
                $sql = "SELECT COUNT(*) as total FROM blog_posts";
                $result = $conn->query($sql);
                $total_posts = $result->fetch_assoc()['total'];
                $total_pages = ceil($total_posts / $posts_per_page);
                ?>
            </div>
        </div>
        <aside class="blog-sidebar">
            <div class="sidebar-section">
                <h3>Categories</h3>
                <ul>
                    <?php
                    $sql = "SELECT DISTINCT category FROM blog_posts WHERE category IS NOT NULL";
                    $categories = $conn->query($sql);
                    while ($cat = $categories->fetch_assoc()):
                    ?>
                        <li><a href="blog.php?category=<?php echo urlencode($cat['category']); ?>"><?php echo htmlspecialchars($cat['category']); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="sidebar-section">
                <h3>Recent Posts</h3>
                <ul>
                    <?php
                    $sql = "SELECT id, title FROM blog_posts ORDER BY publish_date DESC LIMIT 5";
                    $recent = $conn->query($sql);
                    while ($post = $recent->fetch_assoc()):
                    ?>
                        <li><a href="blog-post.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </aside>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>