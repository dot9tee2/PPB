<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'db_connect.php';
    $city = isset($_GET['city']) ? $_GET['city'] : 'Lahore';
    $sql = "SELECT id, title, details FROM projects WHERE city = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $city);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <title><?php echo htmlspecialchars($city); ?> Projects</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/city_projects.css">
</head>

<body>
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
                    <img src="<?php echo htmlspecialchars($img['image_path'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><?php echo htmlspecialchars($project['details']); ?></p>
                    <a href="details.php?id=<?php echo $project['id']; ?>" class="btn">Learn More</a>
                </div>
            <?php endwhile;
            $stmt->close(); ?>
        </section>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>