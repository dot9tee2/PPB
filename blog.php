<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Real Estate Insights</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.ico">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/blog.css">
</head>

<body>
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

                while ($blog = $blogs->fetch_assoc()): ?>
                    <div class="blog-card">
                        <a href="blog-post.php?id=<?php echo $blog['id']; ?>">
                            <?php if ($blog['featured_image']): ?>
                                <img loading="lazy" src="<?php echo htmlspecialchars($blog['featured_image']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                            <p class="meta">Posted on <?php echo htmlspecialchars($blog['publish_date']); ?></p>
                            <p><?php echo htmlspecialchars(substr($blog['excerpt'], 0, 120) . (strlen($blog['excerpt']) > 150 ? '...' : '')); ?></p>
                        </a>
                        <div>
                            <a href="blog-post.php?id=<?php echo $blog['id']; ?>" class="btn">Read More</a>

                        </div>
                    </div>
                <?php endwhile; ?>

                <?php
                $stmt->close();
                $sql = "SELECT COUNT(*) as total FROM blog_posts";
                $result = $conn->query($sql);
                $total_posts = $result->fetch_assoc()['total'];
                $total_pages = ceil($total_posts / $posts_per_page);
                ?>
            </div>
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