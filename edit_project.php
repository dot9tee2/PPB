<?php
include 'db_connect.php';

$project_id = (int)$_GET['id'];
$sql = "SELECT * FROM projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

// Fetch images
$sql_img = "SELECT * FROM project_images WHERE project_id = ?";
$stmt_img = $conn->prepare($sql_img);
$stmt_img->bind_param("i", $project_id);
$stmt_img->execute();
$images = $stmt_img->get_result();

// Fetch pricing
$sql_price = "SELECT * FROM project_pricing WHERE project_id = ?";
$stmt_price = $conn->prepare($sql_price);
$stmt_price->bind_param("i", $project_id);
$stmt_price->execute();
$pricing = $stmt_price->get_result();

// Function to sanitize and convert YouTube URL to embed format
function sanitize_youtube_url($url)
{
    $url = trim($url);
    // Check if it's a YouTube watch URL or short URL
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $match)) {
        $video_id = $match[1];
    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $match)) {
        $video_id = $match[1];
    } else {
        // Assume it's already an embed URL or invalid
        return $url;
    }
    return "https://www.youtube.com/embed/" . $video_id . "?enablejsapi=1&rel=0";
}

// Handle form submission
if (isset($_POST['edit_project'])) {
    $title = $_POST['title'];
    $details = $_POST['details'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $amenities = !empty($_POST['amenities']) ? json_encode(explode("\n", trim($_POST['amenities']))) : null;
    $video_url = !empty($_POST['video_url']) ? sanitize_youtube_url($_POST['video_url']) : null; // Sanitize URL
    $map_url = !empty($_POST['map_url']) ? $_POST['map_url'] : null;
    $developers = !empty($_POST['developers']) ? $_POST['developers'] : null;
    $testimonials = !empty($_POST['testimonials']) ? json_encode(explode("\n", trim($_POST['testimonials']))) : null;

    $sql = "UPDATE projects SET title=?, details=?, city=?, location=?, description=?, amenities=?, video_url=?, map_url=?, developers=?, testimonials=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $title, $details, $city, $location, $description, $amenities, $video_url, $map_url, $developers, $testimonials, $project_id);
    $stmt->execute();

    // Handle new images
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $image_path = "uploads/" . basename($name);
            move_uploaded_file($tmp_name, $image_path);
            $sql_img = "INSERT INTO project_images (project_id, image_path) VALUES (?, ?)";
            $stmt_img = $conn->prepare($sql_img);
            $stmt_img->bind_param("is", $project_id, $image_path);
            $stmt_img->execute();
        }
    }

    // Handle pricing updates
    if (!empty($_POST['plot_size'])) {
        $conn->query("DELETE FROM project_pricing WHERE project_id = $project_id"); // Reset pricing
        foreach ($_POST['plot_size'] as $index => $plot_size) {
            if (!empty($plot_size)) {
                $price = $_POST['price'][$index];
                $payment_plan = $_POST['payment_plan'][$index];
                $sql_price = "INSERT INTO project_pricing (project_id, plot_size, price, payment_plan) VALUES (?, ?, ?, ?)";
                $stmt_price = $conn->prepare($sql_price);
                $stmt_price->bind_param("isss", $project_id, $plot_size, $price, $payment_plan);
                $stmt_price->execute();
            }
        }
    }

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - <?php echo htmlspecialchars($project['title']); ?></title>
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
        }

        label {
            display: block;
            margin: var(--spacing-sm) 0 5px;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: var(--spacing-md);
            border: 1px solid var(--light-gray);
            border-radius: 5px;
        }

        textarea {
            min-height: 100px;
        }

        .pricing-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .image-preview img {
            max-width: 100px;
            margin: var(--spacing-sm);
        }

        .toggle-section {
            display: none;
        }

        .toggle-section.active {
            display: block;
        }

        .toggle-btn {
            background: var(--accent-color);
            color: #333;
            margin-bottom: var(--spacing-md);
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="admin-container">
        <div class="form-section">
            <h2>Edit Project: <?php echo htmlspecialchars($project['title']); ?></h2>
            <form method="POST" enctype="multipart/form-data">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>

                <label>City:</label>
                <select name="city" required>
                    <option value="Lahore" <?php if ($project['city'] == 'Lahore') echo 'selected'; ?>>Lahore</option>
                    <option value="Islamabad" <?php if ($project['city'] == 'Islamabad') echo 'selected'; ?>>Islamabad</option>
                    <option value="Sialkot" <?php if ($project['city'] == 'Sialkot') echo 'selected'; ?>>Sialkot</option>
                </select>

                <label>Location:</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($project['location']); ?>" required>

                <label>Details:</label>
                <textarea name="details" required><?php echo htmlspecialchars($project['details']); ?></textarea>

                <label>Description:</label>
                <textarea name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>

                <?php if ($project['amenities']): ?>
                    <label>Amenities (one per line):</label>
                    <textarea name="amenities"><?php echo implode("\n", json_decode($project['amenities'], true)); ?></textarea>
                <?php else: ?>
                    <button type="button" class="btn toggle-btn" onclick="toggleSection('amenities-section')">Add Amenities</button>
                    <div id="amenities-section" class="toggle-section">
                        <label>Amenities (one per line):</label>
                        <textarea name="amenities"></textarea>
                    </div>
                <?php endif; ?>

                <?php if ($project['video_url']): ?>
                    <label>Video URL:</label>
                    <input type="url" name="video_url" value="<?php echo htmlspecialchars($project['video_url']); ?>">
                <?php else: ?>
                    <button type="button" class="btn toggle-btn" onclick="toggleSection('video-section')">Add Video Tour</button>
                    <div id="video-section" class="toggle-section">
                        <label>Video URL:</label>
                        <input type="url" name="video_url">
                    </div>
                <?php endif; ?>

                <?php if ($project['map_url']): ?>
                    <label>Map URL:</label>
                    <input type="url" name="map_url" value="<?php echo htmlspecialchars($project['map_url']); ?>">
                <?php else: ?>
                    <button type="button" class="btn toggle-btn" onclick="toggleSection('map-section')">Add Map</button>
                    <div id="map-section" class="toggle-section">
                        <label>Map URL:</label>
                        <input type="url" name="map_url">
                    </div>
                <?php endif; ?>

                <?php if ($project['developers']): ?>
                    <label>Developers:</label>
                    <textarea name="developers"><?php echo htmlspecialchars($project['developers']); ?></textarea>
                <?php else: ?>
                    <button type="button" class="btn toggle-btn" onclick="toggleSection('developers-section')">Add Developers</button>
                    <div id="developers-section" class="toggle-section">
                        <label>Developers:</label>
                        <textarea name="developers"></textarea>
                    </div>
                <?php endif; ?>

                <?php if ($project['testimonials']): ?>
                    <label>Testimonials (one per line):</label>
                    <textarea name="testimonials"><?php echo implode("\n", json_decode($project['testimonials'], true)); ?></textarea>
                <?php else: ?>
                    <button type="button" class="btn toggle-btn" onclick="toggleSection('testimonials-section')">Add Testimonials</button>
                    <div id="testimonials-section" class="toggle-section">
                        <label>Testimonials (one per line):</label>
                        <textarea name="testimonials"></textarea>
                    </div>
                <?php endif; ?>

                <label>Current Images:</label>
                <div class="image-preview">
                    <?php while ($img = $images->fetch_assoc()): ?>
                        <img src="<?php echo htmlspecialchars($img['image_path']); ?>" alt="Project Image">
                    <?php endwhile; ?>
                </div>
                <label>Add More Images:</label>
                <input type="file" name="images[]" multiple accept="image/*">

                <?php if ($pricing->num_rows > 0): ?>
                    <label>Pricing:</label>
                    <div id="pricing-container">
                        <?php while ($price = $pricing->fetch_assoc()): ?>
                            <div class="pricing-row">
                                <input type="text" name="plot_size[]" value="<?php echo htmlspecialchars($price['plot_size']); ?>" placeholder="Plot Size">
                                <input type="text" name="price[]" value="<?php echo htmlspecialchars($price['price']); ?>" placeholder="Price (PKR)">
                                <input type="text" name="payment_plan[]" value="<?php echo htmlspecialchars($price['payment_plan']); ?>" placeholder="Payment Plan">
                                <button type="button" onclick="this.parentElement.remove()">Remove</button>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <button type="button" onclick="addPricingRow()" class="btn">Add Pricing Row</button>
                <?php else: ?>
                    <button type="button" class="btn toggle-btn" onclick="toggleSection('pricing-section')">Add Pricing</button>
                    <div id="pricing-section" class="toggle-section">
                        <label>Pricing:</label>
                        <div id="pricing-container">
                            <div class="pricing-row">
                                <input type="text" name="plot_size[]" placeholder="Plot Size">
                                <input type="text" name="price[]" placeholder="Price (PKR)">
                                <input type="text" name="payment_plan[]" placeholder="Payment Plan">
                                <button type="button" onclick="addPricingRow()">Add More</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <input type="submit" name="edit_project" value="Update Project" class="btn">
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.classList.toggle('active');
        }

        function addPricingRow() {
            const container = document.getElementById('pricing-container');
            const row = document.createElement('div');
            row.className = 'pricing-row';
            row.innerHTML = `
                <input type="text" name="plot_size[]" placeholder="Plot Size">
                <input type="text" name="price[]" placeholder="Price (PKR)">
                <input type="text" name="payment_plan[]" placeholder="Payment Plan">
                <button type="button" onclick="this.parentElement.remove()">Remove</button>
            `;
            container.appendChild(row);
        }
    </script>
</body>

</html>