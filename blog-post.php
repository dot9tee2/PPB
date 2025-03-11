<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'db_connect.php';
    $blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $sql = "SELECT * FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $blog = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    ?>
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <link rel="icon" type="image/x-icon" href="media/favicon.ico">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/blog.css">
    <!-- Add Boxicons for social icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="blog-container">
        <div class="blog-main">
            <?php if ($blog): ?>
                <!-- Blog Post Header -->
                <header class="blog-header">
                    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
                    <p class="meta">Posted by <?php echo htmlspecialchars($blog['author'] ?? 'Admin'); ?> on <?php echo htmlspecialchars($blog['publish_date']); ?></p>
                    <?php if ($blog['featured_image']): ?>
                        <img src="<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']) . ' featured image'; ?>" class="featured-image">
                    <?php endif; ?>
                </header>

                <!-- Optional Table of Contents -->
                <?php
                /*
                echo '<div class="toc"><h3>Table of Contents</h3><ul>';
                $sections = explode('###', $blog['content']);
                foreach (array_slice($sections, 1) as $index => $section) {
                    $heading = trim(preg_split('/\n+/', $section)[0]);
                    echo '<li><a href="#section-' . $index . '">' . htmlspecialchars($heading) . '</a></li>';
                    echo str_replace($heading, '<h2 id="section-' . $index . '">' . htmlspecialchars($heading) . '</h2>', $section);
                }
                echo '</ul></div>';
                */
                ?>

                <!-- Blog Content -->
                <article class="blog-content">
                    <?php
                    // Split content into sections using ### as delimiter
                    $sections = explode('###', $blog['content']);
                    foreach ($sections as $index => $section) {
                        $section = trim($section);
                        if ($section) {
                            if ($index === 0) {
                                // Apply nl2br only to the introductory paragraph
                                echo '<p>' . nl2br(htmlspecialchars($section)) . '</p>';
                            } else {
                                // Split section into heading and content
                                $parts = preg_split('/\n+/', $section, 2);
                                $heading = trim($parts[0]);
                                $content = trim($parts[1] ?? '');
                                if ($heading) {
                                    // Display heading without nl2br to avoid <br>
                                    echo '<h2>' . htmlspecialchars($heading) . '</h2>';
                                }
                                if ($content) {
                                    // Apply nl2br only to the paragraph content
                                    echo '<p>' . nl2br(htmlspecialchars($content)) . '</p>';
                                    // Add a pull quote every few paragraphs (no inline images)
                                    if ($index % 3 === 0) {
                                        echo '<blockquote>"Real estate is about smart decisions—invest wisely!"</blockquote>';
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </article>

                <!-- Social Sharing Buttons -->
                <div class="social-share">
                    <h3>Share This Post</h3>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog-post.php?id=' . $blog['id']); ?>&text=<?php echo urlencode($blog['title']); ?>" target="_blank" aria-label="Share on Twitter"><i class='bx bxl-twitter'></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://pakistanpropertiesandbuilders.com/blog-post.php?id=' . $blog['id']); ?>" target="_blank" aria-label="Share on Facebook"><i class='bx bxl-facebook'></i></a>
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($blog['title'] . ' - https://pakistanpropertiesandbuilders.com/blog-post.php?id=' . $blog['id']); ?>" target="_blank" aria-label="Share on WhatsApp"><i class='bx bxl-whatsapp'></i></a>
                </div>

                <!-- Optional Author Bio -->
                <?php
                /*
                echo '<div class="author-bio"><h3>About the Author</h3><p>' . htmlspecialchars($blog['author'] ?? 'Admin') . ' is a real estate expert with over 10 years of experience.</p></div>';
                */
                ?>

                <!-- Related Posts -->
                <h2>Related Posts</h2>
                <div class="blog-grid">
                    <?php
                    $sql = "SELECT * FROM blog_posts WHERE id != ? ORDER BY publish_date DESC LIMIT 3";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $blog_id);
                    $stmt->execute();
                    $related = $stmt->get_result();
                    while ($post = $related->fetch_assoc()):
                        $image = !empty($post['featured_image']) ? htmlspecialchars($post['featured_image']) : 'media/blog.jpg';
                    ?>
                        <div class="blog-card">
                            <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="meta">Posted on <?php echo htmlspecialchars($post['publish_date']); ?></p>
                            <p><?php echo htmlspecialchars(substr($post['excerpt'], 0, 100) . (strlen($post['excerpt']) > 100 ? '...' : '')); ?></p>
                            <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="btn">Read More</a>
                        </div>
                    <?php endwhile; ?>
                    <?php $stmt->close(); ?>
                </div>
            <?php else: ?>
                <h1>Blog Post Not Found</h1>
                <p>Sorry, the blog post you’re looking for doesn’t exist.</p>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="blog-sidebar">
            <div class="sidebar-section">
                <h3>Categories</h3>
                <ul>
                    <?php
                    $sql = "SELECT DISTINCT category FROM blog_posts WHERE category IS NOT NULL";
                    $categories = $conn->query($sql);
                    while ($cat = $categories->fetch_assoc()): ?>
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
                    while ($post = $recent->fetch_assoc()): ?>
                        <li><a href="blog-post.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </aside>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>