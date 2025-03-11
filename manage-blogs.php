<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin.php");
    exit;
}

// Handle adding a new blog post
if (isset($_POST['add_blog'])) {
    $title = $_POST['title'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $category = !empty($_POST['category']) ? $_POST['category'] : null;
    $publish_date = $_POST['publish_date'];

    $featured_image = null;
    if (!empty($_FILES['featured_image']['name'])) {
        $tmp_name = $_FILES['featured_image']['tmp_name'];
        $image_path = "uploads/" . basename($_FILES['featured_image']['name']);
        move_uploaded_file($tmp_name, $image_path);
        $featured_image = $image_path;
    }

    $sql = "INSERT INTO blog_posts (title, excerpt, content, featured_image, category, publish_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $title, $excerpt, $content, $featured_image, $category, $publish_date);
    $stmt->execute();
    $stmt->close();
    header("Location: " . basename(__FILE__)); // Reload the page
    exit;
}

// Handle editing an existing blog post
if (isset($_POST['edit_blog']) && isset($_POST['edit_id'])) {
    $id = (int)$_POST['edit_id'];
    $title = $_POST['title'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $category = !empty($_POST['category']) ? $_POST['category'] : null;
    $publish_date = $_POST['publish_date'];

    $featured_image = null;
    if (!empty($_FILES['featured_image']['name'])) {
        $tmp_name = $_FILES['featured_image']['tmp_name'];
        $image_path = "uploads/" . basename($_FILES['featured_image']['name']);
        move_uploaded_file($tmp_name, $image_path);
        $featured_image = $image_path;
    } else {
        // Keep the existing image if no new one is uploaded
        $sql = "SELECT featured_image FROM blog_posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $featured_image = $result['featured_image'];
        $stmt->close();
    }

    $sql = "UPDATE blog_posts SET title=?, excerpt=?, content=?, featured_image=?, category=?, publish_date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $title, $excerpt, $content, $featured_image, $category, $publish_date, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . basename(__FILE__)); // Reload the page
    exit;
}

// Handle deleting a blog post
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . basename(__FILE__)); // Reload the page
    exit;
}

// Fetch existing blog posts
$sql = "SELECT * FROM blog_posts ORDER BY publish_date DESC";
$blogs = $conn->query($sql);

// Fetch a specific blog post for editing (if edit action is triggered)
$edit_blog = null;
if (isset($_GET['edit']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_blog = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs - PPB</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.ico">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: var(--spacing-lg) auto;
            padding: var(--spacing-md);
        }

        .form-section {
            background: #fff;
            padding: var(--spacing-lg);
            border-radius: 5px;
            box-shadow: var(--shadow);
            margin-bottom: var(--spacing-lg);
        }

        .blog-list {
            margin-top: var(--spacing-lg);
        }

        .blog-item {
            padding: var(--spacing-md);
            border-bottom: 1px solid var(--light-gray);
        }

        .blog-item:last-child {
            border-bottom: none;
        }

        label {
            display: block;
            margin: var(--spacing-sm) 0 5px;
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: var(--spacing-md);
            border: 1px solid var(--light-gray);
            border-radius: 5px;
        }

        textarea {
            min-height: 100px;
        }

        .image-preview img {
            max-width: 100px;
            margin: var(--spacing-sm);
        }

        .edit-form {
            display: none;
        }

        .edit-form.active {
            display: block;
        }

        .btn-back {
            background: var(--light-gray);
            color: #333;
            margin-bottom: var(--spacing-md);
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="admin-container">
        <a href="admin.php" class="btn btn-back">Back to Admin Dashboard</a>

        <!-- Add New Blog Form -->
        <div class="form-section">
            <h2>Add New Blog Post</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="add_blog" value="1">
                <label>Title:</label>
                <input type="text" name="title" value="" required>

                <label>Excerpt (Short Summary):</label>
                <textarea name="excerpt" required></textarea>

                <label>Content:</label>
                <textarea name="content" required></textarea>

                <label>Featured Image:</label>
                <input type="file" name="featured_image" accept="image/*">

                <label>Category:</label>
                <input type="text" name="category" placeholder="e.g., Market Trends">

                <label>Publish Date:</label>
                <input type="date" name="publish_date" value="<?php echo date('Y-m-d'); ?>" required>

                <input type="submit" value="Add Blog Post" class="btn">
            </form>
        </div>

        <!-- Edit Blog Form (hidden by default, shown when editing) -->
        <?php if ($edit_blog): ?>
            <div class="form-section edit-form active">
                <h2>Edit Blog Post: <?php echo htmlspecialchars($edit_blog['title']); ?></h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $edit_blog['id']; ?>">
                    <input type="hidden" name="edit_blog" value="1">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($edit_blog['title']); ?>" required>

                    <label>Excerpt (Short Summary):</label>
                    <textarea name="excerpt" required><?php echo htmlspecialchars($edit_blog['excerpt']); ?></textarea>

                    <label>Content:</label>
                    <textarea name="content" required><?php echo htmlspecialchars($edit_blog['content']); ?></textarea>

                    <label>Current Featured Image:</label>
                    <?php if ($edit_blog['featured_image']): ?>
                        <div class="image-preview">
                            <img src="<?php echo htmlspecialchars($edit_blog['featured_image']); ?>" alt="Featured Image">
                        </div>
                    <?php endif; ?>
                    <label>Upload New Featured Image:</label>
                    <input type="file" name="featured_image" accept="image/*">

                    <label>Category:</label>
                    <input type="text" name="category" value="<?php echo htmlspecialchars($edit_blog['category']); ?>" placeholder="e.g., Market Trends">

                    <label>Publish Date:</label>
                    <input type="date" name="publish_date" value="<?php echo htmlspecialchars($edit_blog['publish_date']); ?>" required>

                    <input type="submit" value="Update Blog Post" class="btn">
                    <a href="manage-blogs.php" class="btn btn-back">Cancel</a>
                </form>
            </div>
        <?php endif; ?>

        <!-- List Existing Blogs -->
        <div class="form-section blog-list">
            <h2>Manage Blog Posts</h2>
            <?php if ($blogs->num_rows > 0): ?>
                <?php while ($blog = $blogs->fetch_assoc()): ?>
                    <div class="blog-item">
                        <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
                        <p>Published: <?php echo htmlspecialchars($blog['publish_date']); ?></p>
                        <a href="manage-blogs.php?edit=1&id=<?php echo $blog['id']; ?>" class="btn">Edit</a>
                        <a href="manage-blogs.php?delete=1&id=<?php echo $blog['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No blog posts found.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>