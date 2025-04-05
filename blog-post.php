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
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
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
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="blog-container">
        <div class="blog-main">
            <?php if ($blog): ?>
                <header class="blog-header">
                    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
                    <p class="meta">Posted by <?php echo htmlspecialchars($blog['author'] ?? 'Admin'); ?> on <?php echo htmlspecialchars($blog['publish_date']); ?></p>
                    <?php if ($blog['featured_image']): ?>
                        <img src="/<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']) . ' featured image'; ?>" class="featured-image" />
                    <?php endif; ?>
                </header>
                <article class="blog-content">
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
                </article>
                <div class="social-share">
                    <h3>Share This Article</h3>
                    <div class="share-buttons">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" 
                           target="_blank" 
                           class="share-button facebook" 
                           aria-label="Share on Facebook">
                            <i class='bx bxl-facebook'></i>
                            <span>Facebook</span>
                        </a>

                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>&text=<?php echo urlencode($blog['title']); ?>" 
                           target="_blank" 
                           class="share-button twitter" 
                           aria-label="Share on Twitter">
                            <i class='bx bxl-twitter'></i>
                            <span>Twitter</span>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($blog['title'] . ' - https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" 
                           target="_blank" 
                           class="share-button whatsapp" 
                           aria-label="Share on WhatsApp">
                            <i class='bx bxl-whatsapp'></i>
                            <span>WhatsApp</span>
                        </a>

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>&title=<?php echo urlencode($blog['title']); ?>&summary=<?php echo urlencode(substr($blog['excerpt'], 0, 100)); ?>" 
                           target="_blank" 
                           class="share-button linkedin" 
                           aria-label="Share on LinkedIn">
                            <i class='bx bxl-linkedin'></i>
                            <span>LinkedIn</span>
                        </a>

                        <!-- Email -->
                        <a href="mailto:?subject=<?php echo urlencode($blog['title']); ?>&body=<?php echo urlencode('Check out this interesting article: https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" 
                           class="share-button email" 
                           aria-label="Share via Email">
                            <i class='bx bx-envelope'></i>
                            <span>Email</span>
                        </a>

                        <!-- Copy Link Button -->
                        <button onclick="copyPageUrl()" 
                                class="share-button copy-link" 
                                id="copyLinkBtn" 
                                aria-label="Copy link to clipboard">
                            <i class='bx bx-link'></i>
                            <span>Copy Link</span>
                        </button>
                    </div>

                    <!-- Add QR Code for the article -->
                    <div class="qr-code">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog/' . $blog_slug); ?>" 
                             alt="QR Code for this article" 
                             loading="lazy">
                        <p>Scan to read on mobile</p>
                    </div>

                    <script>
                    function copyPageUrl() {
                        const url = 'https://pakistanpropertiesandbuilders.com/blog/<?php echo $blog_slug; ?>';
                        navigator.clipboard.writeText(url).then(function() {
                            const btn = document.getElementById('copyLinkBtn');
                            const originalText = btn.innerHTML;
                            btn.innerHTML = '<i class="bx bx-check"></i><span>Copied!</span>';
                            btn.classList.add('copied');
                            
                            setTimeout(function() {
                                btn.innerHTML = originalText;
                                btn.classList.remove('copied');
                            }, 2000);
                        }).catch(function(err) {
                            console.error('Failed to copy URL: ', err);
                        });
                    }
                    </script>

                    <style>
                    .social-share {
                        margin: 2rem 0;
                        padding: 1.5rem;
                        background: var(--white);
                        border-radius: 8px;
                        text-align: center;
                        box-shadow: var(--shadow);
                    }

                    .social-share h3 {
                        margin-bottom: 1.5rem;
                        color: #333;
                        font-family: var(--font-primary);
                        font-weight: 700;
                    }

                    .share-buttons {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 1rem;
                        justify-content: center;
                        margin-bottom: 1.5rem;
                    }

                    .share-button {
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                        padding: 0.8rem 1.2rem;
                        border-radius: 5px;
                        color: var(--white);
                        text-decoration: none;
                        transition: all 0.3s ease;
                        border: none;
                        cursor: pointer;
                        font-size: 0.9rem;
                        font-family: var(--font-secondary);
                        font-weight: bold;
                    }

                    .share-button:hover {
                        transform: translateY(-2px);
                        background: var(--accent-color) !important;
                        color: #333;
                    }

                    .share-button i {
                        font-size: 1.2rem;
                    }

                    .facebook { background-color: var(--dark-green); }
                    .twitter { background-color: var(--dark-green); }
                    .whatsapp { background-color: var(--dark-green); }
                    .linkedin { background-color: var(--dark-green); }
                    .email { background-color: var(--dark-green); }
                    .copy-link { background-color: var(--dark-green); }

                    .copied {
                        background-color: var(--accent-color) !important;
                        color: #333 !important;
                    }

                    .qr-code {
                        margin-top: 2rem;
                        padding: 1rem;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 0.5rem;
                        background: var(--white);
                        border-radius: 8px;
                        box-shadow: var(--shadow);
                    }

                    .qr-code img {
                        border-radius: 8px;
                        border: 2px solid var(--dark-green);
                    }

                    .qr-code p {
                        color: #333;
                        font-size: 0.9rem;
                        font-family: var(--font-secondary);
                    }

                    @media (max-width: 768px) {
                        .share-buttons {
                            flex-direction: column;
                            align-items: stretch;
                        }

                        .share-button {
                            justify-content: center;
                        }

                        .social-share {
                            margin: 1rem 0;
                            padding: 1rem;
                        }
                    }
                    </style>
                </div>
                <h2>Related Posts</h2>
                <div class="blog-grid">
                    <?php
                    $sql = "SELECT * FROM blog_posts WHERE slug != ? ORDER BY publish_date DESC LIMIT 3";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $blog_slug);
                    $stmt->execute();
                    $related = $stmt->get_result();
                    while ($post = $related->fetch_assoc()):
                        $image = !empty($post['featured_image']) ? htmlspecialchars($post['featured_image']) : 'media/blog.jpg';
                    ?>
                        <div class="blog-card">
                            <img src="/<?php echo $image; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" />
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="meta">Posted on <?php echo htmlspecialchars($post['publish_date']); ?></p>
                            <p><?php echo htmlspecialchars(substr($post['excerpt'], 0, 100) . (strlen($post['excerpt']) > 100 ? '...' : '')); ?></p>
                            <a href="blog/<?php echo $post['slug']; ?>" class="btn">Read More</a>
                        </div>
                    <?php
                    endwhile;
                    $stmt->close();
                    ?>
                </div>
            <?php else: ?>
                <h1>Blog Post Not Found</h1>
                <p>Sorry, the blog post you're looking for doesn't exist.</p>
            <?php endif; ?>
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
                    $sql = "SELECT slug, title FROM blog_posts ORDER BY publish_date DESC LIMIT 5";
                    $recent = $conn->query($sql);
                    while ($post = $recent->fetch_assoc()):
                    ?>
                        <li><a href="blog/<?php echo $post['slug']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </aside>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>