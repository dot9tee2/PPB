<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'db_connect.php';
    $project_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $project = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $title = $project ? $project['title'] : 'Project Not Found';
    ?>
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/details.css">
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet" />
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="main-content">
        <?php if ($project): ?>

            <!-- Main Content Section -->
            <h1><?php echo htmlspecialchars($project['title']); ?></h1>
            <p><?php echo htmlspecialchars($project['details']); ?></p>
            <p><?php echo htmlspecialchars($project['description']); ?></p>
            <!-- Project Gallery -->
            <section class="gallery animate-on-scroll">
                <h2>Project Gallery</h2>
                <div class="image-slider">
                    <?php
                    $sql = "SELECT image_path FROM project_images WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $images = $stmt->get_result();
                    while ($image = $images->fetch_assoc()) {
                        echo '<img src="' . htmlspecialchars($image['image_path']) . '" alt="Project Image">';
                    }
                    $stmt->close();
                    ?>
                </div>
            </section>

            <!-- Video Tour -->
            <?php if ($project['video_url']): ?>
                <section class="video-tour animate-on-scroll">
                    <h2>Virtual Tour</h2>
                    <iframe src="<?php echo htmlspecialchars($project['video_url']); ?>" allowfullscreen></iframe>
                </section>
            <?php endif; ?>

            <!-- Amenities -->
            <section class="amenities animate-on-scroll">
                <h2>Key Amenities</h2>
                <ul class="amenities-list">
                    <?php
                    $amenities = json_decode($project['amenities'], true);
                    foreach ($amenities as $amenity) {
                        echo '<li>' . htmlspecialchars($amenity) . '</li>';
                    }
                    ?>
                </ul>
            </section>

            <!-- Pre-Booking Prices -->
            <section class="pricing animate-on-scroll">
                <h2>Pre-Booking Prices</h2>
                <table>
                    <tr>
                        <th>Plot Size</th>
                        <th>Price (PKR)</th>
                        <th>Payment Plan</th>
                    </tr>
                    <?php
                    $sql = "SELECT plot_size, price, payment_plan FROM project_pricing WHERE project_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $project_id);
                    $stmt->execute();
                    $pricing = $stmt->get_result();
                    while ($price = $pricing->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($price['plot_size']) . "</td>
                            <td>" . htmlspecialchars($price['price']) . "</td>
                            <td>" . htmlspecialchars($price['payment_plan']) . "</td>
                        </tr>";
                    }
                    $stmt->close();
                    ?>
                </table>
            </section>

            <!-- Location with Map -->
            <section class="location-map animate-on-scroll">
                <h2>Location</h2>
                <p><?php echo htmlspecialchars($project['location']); ?></p>
                <?php if ($project['map_url']): ?>
                    <iframe src="<?php echo htmlspecialchars($project['map_url']); ?>" allowfullscreen loading="lazy"></iframe>
                <?php endif; ?>
            </section>

            <!-- Developers Profile -->
            <?php if ($project['developers']): ?>
                <section class="developers animate-on-scroll">
                    <h2>Meet the Developers</h2>
                    <p><?php echo htmlspecialchars($project['developers']); ?></p>
                </section>
            <?php endif; ?>

            <!-- Testimonials -->
            <?php if ($project['testimonials']): ?>
                <section class="testimonials animate-on-scroll">
                    <h2>What Our Clients Say</h2>
                    <?php
                    $testimonials = json_decode($project['testimonials'], true);
                    foreach ($testimonials as $testimonial) {
                        echo '<blockquote><p>' . htmlspecialchars($testimonial) . '</p></blockquote>';
                    }
                    ?>
                </section>
            <?php endif; ?>

            <a href="#contact" class="btn">Contact Us</a>
        <?php else: ?>
            <h1>Project Not Found</h1>
            <p>Sorry, the project you’re looking for doesn’t exist.</p>
        <?php endif; ?>
    </div>

    <a href="#contact" class="sticky-cta">Book Now</a>
    <?php include 'footer.php'; ?>
</body>

</html>