<?php
include 'db_connect.php';
$blog_slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$sql = "SELECT * FROM blog_posts WHERE slug = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $blog_slug);
$stmt->execute();
$blog = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$blog) {
    header("HTTP/1.0 404 Not Found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    $sql = "SELECT * FROM blog_posts WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $blog_slug);
    $stmt->execute();
    $blog = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    ?>
    <meta name="description" content="<?php echo htmlspecialchars(substr($blog['excerpt'], 0, 160)); ?>" />
    <meta name="keywords" content="real estate blog, <?php echo htmlspecialchars($blog['title']); ?>, Pakistan Properties, property tips" />
    <!-- Open Graph tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($blog['title']); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars(substr($blog['excerpt'], 0, 160)); ?>" />
    <meta property="og:image" content="<?php echo htmlspecialchars($blog['featured_image'] ?? 'https://www.pakistanpropertiesandbuilders.com/media/default-blog.jpg'); ?>" />
    <meta property="og:url" content="https://www.pakistanpropertiesandbuilders.com/blog/<?php echo htmlspecialchars($blog_slug); ?>" />
    <meta property="og:type" content="article" />
    <meta property="article:published_time" content="<?php echo htmlspecialchars($blog['publish_date']); ?>" />
    <meta property="article:author" content="<?php echo htmlspecialchars($blog['author'] ?? 'Admin'); ?>" />
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo htmlspecialchars($blog['title']); ?>" />
    <meta name="twitter:description" content="<?php echo htmlspecialchars(substr($blog['excerpt'], 0, 160)); ?>" />
    <meta name="twitter:image" content="<?php echo htmlspecialchars($blog['featured_image'] ?? 'https://www.pakistanpropertiesandbuilders.com/media/default-blog.jpg'); ?>" />
    <title><?php echo htmlspecialchars($blog['title']); ?> - Your Blog</title>
    <link rel="icon" type="image/x-icon" href="/media/favicon.ico" />
    <link rel="sitemap" type="application/xml" href="/sitemap.xml" />
    <link rel="stylesheet" href="/css/navbar.css" />
    <link rel="stylesheet" href="/css/footer.css" />
    <link rel="stylesheet" href="/css/base.css" />
    <link rel="stylesheet" href="/css/blog.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" />
    <link rel="canonical" href="https://www.pakistanpropertiesandbuilders.com/blog/<?php echo htmlspecialchars($blog_slug); ?>" />
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "<?php echo htmlspecialchars($blog['title']); ?>",
        "description": "<?php echo htmlspecialchars(substr($blog['excerpt'], 0, 160)); ?>",
        "image": "<?php echo htmlspecialchars($blog['featured_image'] ?? 'https://www.pakistanpropertiesandbuilders.com/media/default-blog.jpg'); ?>",
        "author": {
            "@type": "Person",
            "name": "<?php echo htmlspecialchars($blog['author'] ?? 'Admin'); ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Pakistan Properties and Builders",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.pakistanpropertiesandbuilders.com/logo.png"
            }
        },
        "datePublished": "<?php echo htmlspecialchars($blog['publish_date']); ?>",
        "dateModified": "<?php echo htmlspecialchars($blog['update_date'] ?? $blog['publish_date']); ?>",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "https://www.pakistanpropertiesandbuilders.com/blog/<?php echo htmlspecialchars($blog_slug); ?>"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://www.pakistanpropertiesandbuilders.com/" },
            { "@type": "ListItem", "position": 2, "name": "Blog", "item": "https://www.pakistanpropertiesandbuilders.com/blog.php" },
            { "@type": "ListItem", "position": 3, "name": "<?php echo htmlspecialchars($blog['title']); ?>", "item": "https://www.pakistanpropertiesandbuilders.com/blog/<?php echo htmlspecialchars($blog_slug); ?>" }
        ]
    }
    </script>
    <style>
    /* Base styles for blog container */
    .blog-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        display: flex;
        gap: 2rem;
    }

    .blog-main {
        flex: 1;
        min-width: 0; /* Prevents flex item from overflowing */
    }

    .blog-sidebar {
        width: 300px;
    }

    /* Blog header styles */
    .blog-header {
        margin-bottom: 2rem;
    }

    .blog-header h1 {
        font-size: 2.5rem;
        color: var(--dark-green);
        line-height: 1.3;
        margin-bottom: 1rem;
        font-family: var(--font-primary);
    }

    .blog-header .meta {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .blog-header .featured-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    /* Blog content styles */
    .blog-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .blog-content p {
        margin-bottom: 1.5rem;
    }

    .blog-content h2 {
        color: var(--dark-green);
        font-size: 1.8rem;
        margin: 2rem 0 1rem;
        font-family: var(--font-primary);
    }

    .blog-content blockquote {
        border-left: 4px solid var(--dark-green);
        margin: 2rem 0;
        padding: 1rem 2rem;
        background: #f8f9fa;
        border-radius: 0 10px 10px 0;
        font-style: italic;
        color: #555;
    }

    /* Sidebar styles */
    .sidebar-section {
        background: var(--white);
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .sidebar-section h3 {
        color: var(--dark-green);
        margin-bottom: 1rem;
        font-family: var(--font-primary);
        font-size: 1.3rem;
    }

    .sidebar-section ul {
        list-style: none;
        padding: 0;
    }

    .sidebar-section li {
        margin-bottom: 0.8rem;
    }

    .sidebar-section a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .sidebar-section a:hover {
        color: var(--dark-green);
    }

    /* Related posts grid */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .blog-card {
        background: var(--white);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px);
    }

    .blog-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .blog-card h3 {
        font-size: 1.2rem;
        margin: 1rem;
        color: var(--dark-green);
    }

    .blog-card p {
        margin: 1rem;
        color: #666;
        font-size: 0.9rem;
    }

    .blog-card .btn {
        margin: 0 1rem 1rem;
        display: inline-block;
    }

    /* Responsive styles */
    @media (max-width: 1024px) {
        .blog-container {
            padding: 15px;
            gap: 1.5rem;
        }

        .blog-sidebar {
            width: 250px;
        }

        .blog-header h1 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .blog-container {
            flex-direction: column;
            padding: 10px;
        }

        .blog-sidebar {
            width: 100%;
        }

        .blog-header h1 {
            font-size: 1.8rem;
        }

        .blog-content {
            font-size: 1rem;
        }

        .blog-content h2 {
            font-size: 1.5rem;
        }

        .blog-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .social-share {
            margin: 1.5rem 0;
            padding: 1.5rem;
        }

        .share-buttons {
            gap: 0.8rem;
        }

        .share-button {
            width: 45px;
            height: 45px;
        }

        .share-button i {
            font-size: 1.5rem;
        }

        .qr-code {
            padding: 1rem;
        }

        .qr-code img {
            width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 480px) {
        .blog-container {
            padding: 10px;
        }

        .blog-header h1 {
            font-size: 1.5rem;
        }

        .blog-header .meta {
            font-size: 0.85rem;
        }

        .blog-content {
            font-size: 0.95rem;
        }

        .blog-content h2 {
            font-size: 1.3rem;
        }

        .blog-content blockquote {
            padding: 0.8rem 1.2rem;
            margin: 1.5rem 0;
        }

        .sidebar-section {
            padding: 1rem;
        }

        .sidebar-section h3 {
            font-size: 1.2rem;
        }

        .blog-card h3 {
            font-size: 1.1rem;
        }

        .social-share h3 {
            font-size: 1.3rem;
        }

        .share-buttons {
            gap: 0.6rem;
        }

        .share-button {
            width: 40px;
            height: 40px;
        }

        .share-button i {
            font-size: 1.3rem;
        }
    }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="blog-container">
        <main class="blog-main">
            <article>
                <header class="blog-header">
                    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
                    <div class="meta">
                        <span><i class='bx bx-calendar'></i> <?php echo date('F j, Y', strtotime($blog['publish_date'])); ?></span>
                        <span><i class='bx bx-user'></i> <?php echo htmlspecialchars($blog['author'] ?? 'Admin'); ?></span>
                        <span><i class='bx bx-folder'></i> <?php echo htmlspecialchars($blog['category'] ?? 'Uncategorized'); ?></span>
                    </div>
                    <?php if ($blog['featured_image']): ?>
                        <img class="featured-image" src="/<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
                    <?php endif; ?>
                </header>

                <div class="blog-content">
                    <?php
                    // Array of insightful real estate quotes
                    $quotes = array(
                        "Real estate is about smart decisions—invest wisely!",
                        "The best investment on Earth is earth.",
                        "Don't wait to buy real estate. Buy real estate and wait.",
                        "Real estate cannot be lost or stolen, nor can it be carried away.",
                        "Ninety percent of all millionaires become so through owning real estate.",
                        "Buy land, they're not making it anymore.",
                        "Real estate investing, even on a very small scale, remains a tried and true means of building an individual's cash flow and wealth.",
                        "The best time to buy a home is always five years ago.",
                        "Location, location, location - the three most important factors in real estate.",
                        "In real estate, you make your money when you buy, not when you sell.",
                        "Buying real estate is not only the best way, the quickest way, the safest way, but the only way to become wealthy.",
                        "Real estate is an imperishable asset, ever increasing in value.",
                        "Success in real estate starts when you believe you are worthy of it.",
                        "The house you looked at today and wanted to think about until tomorrow may be the same house someone looked at yesterday and will buy today.",
                        "Real estate provides the highest returns, the greatest values, and the least risk."
                    );
                    
                    $sections = explode('###', $blog['content']);
                    foreach ($sections as $index => $section) {
                        $section = trim($section);
                        if ($section) {
                            if ($index === 0) {
                                echo '<p>' . nl2br(htmlspecialchars($section)) . '</p>';
                            } else {
                                $parts = preg_split('/\n+/', $section, 2);
                                $heading = trim($parts[0]);
                                $content = trim($parts[1] ?? '');
                                if ($heading) {
                                    echo '<h2>' . htmlspecialchars($heading) . '</h2>';
                                }
                                if ($content) {
                                    echo '<p>' . nl2br(htmlspecialchars($content)) . '</p>';
                                    // Show quote only every 5th section or at the end
                                    if ($index % 5 === 0 || $index === count($sections) - 1) {
                                        $random_quote = $quotes[array_rand($quotes)];
                                        echo '<blockquote class="insight-quote">"' . htmlspecialchars($random_quote) . '"</blockquote>';
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>

                <div class="social-share">
                    <h3>Share this article</h3>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" target="_blank" class="share-button">
                            <i class="bx bxl-facebook-circle"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>&text=<?php echo urlencode($blog['title']); ?>" target="_blank" class="share-button">
                            <i class="bx bxl-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode($blog['title'] . ' ' . 'https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" target="_blank" class="share-button">
                            <i class="bx bxl-whatsapp"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>&title=<?php echo urlencode($blog['title']); ?>" target="_blank" class="share-button">
                            <i class="bx bxl-linkedin-square"></i>
                        </a>
                        <a href="mailto:?subject=<?php echo urlencode($blog['title']); ?>&body=<?php echo urlencode('Check out this interesting article: https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" class="share-button">
                            <i class="bx bx-envelope"></i>
                        </a>
                        <button class="share-button" onclick="copyToClipboard()">
                            <i class="bx bx-link-alt"></i>
                        </button>
                    </div>
                    <div class="qr-code">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" alt="QR Code">
                        <p>Scan to read on mobile</p>
                    </div>
                    <div class="copy-success" id="copySuccess">Link copied to clipboard!</div>
                </div>
            </article>

            <h2>Related Posts</h2>
            <section class="blog-grid">
                <?php
                $sql = "SELECT * FROM blog_posts WHERE slug != ? ORDER BY publish_date DESC LIMIT 3";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $blog_slug);
                $stmt->execute();
                $related = $stmt->get_result();
                while ($post = $related->fetch_assoc()):
                    $image = !empty($post['featured_image']) ? htmlspecialchars($post['featured_image']) : 'media/blog.jpg';
                ?>
                    <article class="blog-card">
                        <img src="/<?php echo $image; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" />
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p class="meta">Posted on <?php echo htmlspecialchars($post['publish_date']); ?></p>
                        <p><?php echo htmlspecialchars(substr($post['excerpt'], 0, 100) . (strlen($post['excerpt']) > 100 ? '...' : '')); ?></p>
                        <a href="blog/<?php echo $post['slug']; ?>" class="btn">Read More</a>
                    </article>
                <?php
                endwhile;
                $stmt->close();
                ?>
            </section>
        </main>
        <aside class="blog-sidebar">
            <section class="sidebar-section">
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
            </section>
            <section class="sidebar-section">
                <h3>Recent Posts</h3>
                <ul>
                    <?php
                    $sql = "SELECT slug, title FROM blog_posts ORDER BY publish_date DESC LIMIT 5";
                    $recent = $conn->query($sql);
                    while ($post = $recent->fetch_assoc()):
                    ?>
                        <li><a href="blog/<?php echo $post['slug']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </aside>
    </div>
    <?php include 'footer.php'; ?>

    <script>
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const successMessage = document.getElementById('copySuccess');
                successMessage.classList.add('show');
                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 2000);
            });
        }
    </script>
</body>
</html>