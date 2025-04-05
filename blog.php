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
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/blog" />
    <meta property="og:type" content="website" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Real Estate Insights & News | Pakistan Properties and Builders Blog" />
    <meta name="twitter:description" content="Stay updated with the latest real estate trends and insights. Read our blog for expert advice on buying, selling, and investing in properties." />
    <meta name="twitter:image" content="https://www.pakistanpropertiesandbuilders.com/media/blog-cover.jpg" />
    <title>Real Estate Insights & News | Pakistan Properties and Builders Blog</title>
    <link rel="canonical" href="https://www.pakistanpropertiesandbuilders.com/blog" />
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
            { "@type": "ListItem", "position": 2, "name": "Blog", "item": "https://www.pakistanpropertiesandbuilders.com/blog" }
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
        "url": "https://www.pakistanpropertiesandbuilders.com/blog",
        "mainEntityOfPage": "https://www.pakistanpropertiesandbuilders.com/blog"
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
                
                // Build the query based on filters
                $where_conditions = [];
                $params = [];
                $types = "";
                
                if (isset($_GET['category']) && !empty($_GET['category'])) {
                    $where_conditions[] = "category = ?";
                    $params[] = $_GET['category'];
                    $types .= "s";
                }
                
                $sql = "SELECT * FROM blog_posts";
                if (!empty($where_conditions)) {
                    $sql .= " WHERE " . implode(" AND ", $where_conditions);
                }
                $sql .= " ORDER BY publish_date DESC LIMIT ? OFFSET ?";
                
                $params[] = $posts_per_page;
                $params[] = $offset;
                $types .= "ii";
                
                $stmt = $conn->prepare($sql);
                if (!empty($params)) {
                    $stmt->bind_param($types, ...$params);
                }
                $stmt->execute();
                $blogs = $stmt->get_result();
                
                if ($blogs->num_rows > 0):
                    while ($blog = $blogs->fetch_assoc()):
                ?>
                    <div class="blog-card">
                        <a href="blog/<?php echo htmlspecialchars($blog['slug']); ?>">
                            <?php if ($blog['featured_image']): ?>
                                <div class="blog-image">
                                    <img loading="lazy" src="<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" />
                                </div>
                            <?php endif; ?>
                            <div class="blog-content">
                                <?php if ($blog['category']): ?>
                                    <span class="blog-category"><?php echo htmlspecialchars($blog['category']); ?></span>
                                <?php endif; ?>
                                <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                                <p class="meta">
                                    <i class="far fa-calendar"></i> <?php echo date('F j, Y', strtotime($blog['publish_date'])); ?>
                                </p>
                                <p class="excerpt"><?php echo htmlspecialchars(substr($blog['excerpt'], 0, 120) . (strlen($blog['excerpt']) > 120 ? '...' : '')); ?></p>
                            </div>
                        </a>
                        <div class="blog-footer">
                            <a href="blog/<?php echo htmlspecialchars($blog['slug']); ?>" class="btn">Read More</a>
                        </div>
                    </div>
                <?php
                    endwhile;
                else:
                ?>
                    <div class="no-results">
                        <p>No blog posts found. Try adjusting your search or filters.</p>
                    </div>
                <?php endif; ?>
                
                <?php
                // Get total posts count for pagination
                $count_sql = "SELECT COUNT(*) as total FROM blog_posts";
                if (!empty($where_conditions)) {
                    $count_sql .= " WHERE " . implode(" AND ", $where_conditions);
                }
                $count_stmt = $conn->prepare($count_sql);
                if (!empty($params)) {
                    array_pop($params); // Remove limit
                    array_pop($params); // Remove offset
                    if (!empty($params)) {  // Only bind if we still have parameters after removing limit and offset
                        $count_stmt->bind_param(substr($types, 0, -2), ...$params);
                    }
                }
                $count_stmt->execute();
                $total_posts = $count_stmt->get_result()->fetch_assoc()['total'];
                $total_pages = ceil($total_posts / $posts_per_page);
                
                // Pagination
                if ($total_pages > 1):
                ?>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page-1; ?><?php echo isset($_GET['category']) ? '&category='.urlencode($_GET['category']) : ''; ?>" class="page-link">&laquo; Previous</a>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?php echo $i; ?><?php echo isset($_GET['category']) ? '&category='.urlencode($_GET['category']) : ''; ?>" 
                               class="page-link <?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?php echo $page+1; ?><?php echo isset($_GET['category']) ? '&category='.urlencode($_GET['category']) : ''; ?>" class="page-link">Next &raquo;</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <aside class="blog-sidebar">
            <div class="sidebar-section">
                <h3>Categories</h3>
                <ul>
                    <?php
                    $sql = "SELECT category, COUNT(*) as count FROM blog_posts WHERE category IS NOT NULL GROUP BY category ORDER BY count DESC";
                    $categories = $conn->query($sql);
                    while ($cat = $categories->fetch_assoc()):
                    ?>
                        <li>
                            <a href="blog?category=<?php echo urlencode($cat['category']); ?>" 
                               class="<?php echo isset($_GET['category']) && $_GET['category'] === $cat['category'] ? 'active' : ''; ?>">
                                <?php echo htmlspecialchars($cat['category']); ?>
                                <span class="count">(<?php echo $cat['count']; ?>)</span>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            
            <div class="sidebar-section">
                <h3>Recent Posts</h3>
                <ul>
                    <?php
                    $sql = "SELECT id, title, featured_image, publish_date FROM blog_posts ORDER BY publish_date DESC LIMIT 5";
                    $recent = $conn->query($sql);
                    while ($post = $recent->fetch_assoc()):
                    ?>
                        <li>
                            <a href="blog/<?php echo htmlspecialchars($post['slug']); ?>">
                                <?php if ($post['featured_image']): ?>
                                    <img loading="lazy" src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" />
                                <?php endif; ?>
                                <div class="recent-post-info">
                                    <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                                    <span class="date"><?php echo date('M j, Y', strtotime($post['publish_date'])); ?></span>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            
            <div class="sidebar-section">
                <h3>Popular Tags</h3>
                <div class="tag-cloud">
                    <?php
                    // First check if tags column exists
                    $check_column = $conn->query("SHOW COLUMNS FROM blog_posts LIKE 'tags'");
                    if ($check_column->num_rows > 0) {
                        $sql = "SELECT tags FROM blog_posts WHERE tags IS NOT NULL AND tags != ''";
                        $tags_result = $conn->query($sql);
                        $all_tags = [];
                        if ($tags_result && $tags_result->num_rows > 0) {
                            while ($row = $tags_result->fetch_assoc()) {
                                $tags = explode(',', $row['tags']);
                                foreach ($tags as $tag) {
                                    $tag = trim($tag);
                                    if (!empty($tag)) {
                                        $all_tags[$tag] = isset($all_tags[$tag]) ? $all_tags[$tag] + 1 : 1;
                                    }
                                }
                            }
                            arsort($all_tags);
                            $popular_tags = array_slice($all_tags, 0, 10);
                            foreach ($popular_tags as $tag => $count):
                                ?>
                                <a href="?tag=<?php echo urlencode($tag); ?>" 
                                   class="tag"><?php echo htmlspecialchars($tag); ?> <span class="tag-count">(<?php echo $count; ?>)</span></a>
                                <?php
                            endforeach;
                        } else {
                            echo '<p>No tags available yet.</p>';
                        }
                    } else {
                        echo '<p>Tags feature coming soon!</p>';
                    }
                    ?>
                </div>
            </div>
        </aside>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>