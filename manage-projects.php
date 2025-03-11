<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin.php");
    exit;
}

// Handle adding a new project
if (isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $details = $_POST['details'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $amenities = !empty($_POST['amenities']) ? json_encode(explode("\n", trim($_POST['amenities']))) : null;
    $video_url = !empty($_POST['video_url']) ? $_POST['video_url'] : null;
    $map_url = !empty($_POST['map_url']) ? $_POST['map_url'] : null;
    $developers = !empty($_POST['developers']) ? $_POST['developers'] : null;
    $testimonials = !empty($_POST['testimonials']) ? json_encode(explode("\n", trim($_POST['testimonials']))) : null;

    $sql = "INSERT INTO projects (title, details, city, location, description, amenities, video_url, map_url, developers, testimonials) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $title, $details, $city, $location, $description, $amenities, $video_url, $map_url, $developers, $testimonials);
    $stmt->execute();
    $project_id = $conn->insert_id;

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $image_path = "uploads/" . basename($name);
            move_uploaded_file($tmp_name, $image_path);
            $sql_img = "INSERT INTO project_images (project_id, image_path) VALUES (?, ?)";
            $stmt_img = $conn->prepare($sql_img);
            $stmt_img->bind_param("is", $project_id, $image_path);
            $stmt_img->execute();
            $stmt_img->close();
        }
    }

    if (!empty($_POST['plot_size'])) {
        foreach ($_POST['plot_size'] as $index => $plot_size) {
            if (!empty($plot_size)) {
                $price = $_POST['price'][$index];
                $payment_plan = $_POST['payment_plan'][$index];
                $sql_price = "INSERT INTO project_pricing (project_id, plot_size, price, payment_plan) VALUES (?, ?, ?, ?)";
                $stmt_price = $conn->prepare($sql_price);
                $stmt_price->bind_param("isss", $project_id, $plot_size, $price, $payment_plan);
                $stmt_price->execute();
                $stmt_price->close();
            }
        }
    }
    header("Location: " . basename(__FILE__)); // Reload the page
    exit;
}

// Handle editing an existing project
if (isset($_POST['edit_project']) && isset($_POST['edit_id'])) {
    $id = (int)$_POST['edit_id'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $amenities = !empty($_POST['amenities']) ? json_encode(explode("\n", trim($_POST['amenities']))) : null;
    $video_url = !empty($_POST['video_url']) ? $_POST['video_url'] : null;
    $map_url = !empty($_POST['map_url']) ? $_POST['map_url'] : null;
    $developers = !empty($_POST['developers']) ? $_POST['developers'] : null;
    $testimonials = !empty($_POST['testimonials']) ? json_encode(explode("\n", trim($_POST['testimonials']))) : null;

    $sql = "UPDATE projects SET title=?, details=?, city=?, location=?, description=?, amenities=?, video_url=?, map_url=?, developers=?, testimonials=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $title, $details, $city, $location, $description, $amenities, $video_url, $map_url, $developers, $testimonials, $id);
    $stmt->execute();

    // Handle new images
    if (!empty($_FILES['images']['name'][0])) {
        // Delete existing images
        $sql_del_img = "DELETE FROM project_images WHERE project_id = ?";
        $stmt_del_img = $conn->prepare($sql_del_img);
        $stmt_del_img->bind_param("i", $id);
        $stmt_del_img->execute();
        $stmt_del_img->close();

        // Add new images
        foreach ($_FILES['images']['name'] as $key => $name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $image_path = "uploads/" . basename($name);
            move_uploaded_file($tmp_name, $image_path);
            $sql_img = "INSERT INTO project_images (project_id, image_path) VALUES (?, ?)";
            $stmt_img = $conn->prepare($sql_img);
            $stmt_img->bind_param("is", $id, $image_path);
            $stmt_img->execute();
            $stmt_img->close();
        }
    }

    // Handle pricing updates (delete and re-insert for simplicity)
    if (!empty($_POST['plot_size'])) {
        $sql_del_price = "DELETE FROM project_pricing WHERE project_id = ?";
        $stmt_del_price = $conn->prepare($sql_del_price);
        $stmt_del_price->bind_param("i", $id);
        $stmt_del_price->execute();
        $stmt_del_price->close();

        foreach ($_POST['plot_size'] as $index => $plot_size) {
            if (!empty($plot_size)) {
                $price = $_POST['price'][$index];
                $payment_plan = $_POST['payment_plan'][$index];
                $sql_price = "INSERT INTO project_pricing (project_id, plot_size, price, payment_plan) VALUES (?, ?, ?, ?)";
                $stmt_price = $conn->prepare($sql_price);
                $stmt_price->bind_param("isss", $id, $plot_size, $price, $payment_plan);
                $stmt_price->execute();
                $stmt_price->close();
            }
        }
    }

    $stmt->close();
    header("Location: " . basename(__FILE__)); // Reload the page
    exit;
}

// Handle deleting a project
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Delete associated images and pricing
    $sql_del_img = "DELETE FROM project_images WHERE project_id = ?";
    $stmt_del_img = $conn->prepare($sql_del_img);
    $stmt_del_img->bind_param("i", $id);
    $stmt_del_img->execute();
    $stmt_del_img->close();

    $sql_del_price = "DELETE FROM project_pricing WHERE project_id = ?";
    $stmt_del_price = $conn->prepare($sql_del_price);
    $stmt_del_price->bind_param("i", $id);
    $stmt_del_price->execute();
    $stmt_del_price->close();

    $stmt->close();
    header("Location: " . basename(__FILE__)); // Reload the page
    exit;
}

// Fetch all projects
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

// Fetch a specific project for editing (if edit action is triggered)
$edit_project = null;
if (isset($_GET['edit']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_project = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Fetch associated images
    $sql_img = "SELECT image_path FROM project_images WHERE project_id = ?";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $edit_project['images'] = $stmt_img->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_img->close();

    // Fetch associated pricing
    $sql_price = "SELECT plot_size, price, payment_plan FROM project_pricing WHERE project_id = ?";
    $stmt_price = $conn->prepare($sql_price);
    $stmt_price->bind_param("i", $id);
    $stmt_price->execute();
    $edit_project['pricing'] = $stmt_price->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_price->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - PPB</title>
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

        .form-section h2 {
            margin-bottom: var(--spacing-md);
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

        .projects-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .projects-table th,
        .projects-table td {
            padding: var(--spacing-md);
            border: 1px solid var(--light-gray);
            text-align: left;
        }

        .projects-table th {
            background: var(--dark-green);
            color: var(--white);
        }

        .btn-delete {
            background: #d9534f;
        }

        .btn-delete:hover {
            background: #c9302c;
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

        .btn-back {
            background: var(--light-gray);
            color: #333;
            margin-bottom: var(--spacing-md);
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
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="admin-container">
        <a href="admin.php" class="btn btn-back">Back to Admin Dashboard</a>

        <!-- Add New Project Form -->
        <div class="form-section">
            <h2>Add New Project</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="add_project" value="1">
                <label>Title:</label>
                <input type="text" name="title" value="" required>

                <label>City:</label>
                <select name="city" required>
                    <option value="Lahore">Lahore</option>
                    <option value="Islamabad">Islamabad</option>
                    <option value="Sialkot">Sialkot</option>
                </select>

                <label>Location:</label>
                <input type="text" name="location" required>

                <label>Details:</label>
                <textarea name="details" required></textarea>

                <label>Description:</label>
                <textarea name="description" required></textarea>

                <button type="button" class="btn toggle-btn" onclick="toggleSection('amenities-section')">Add Amenities</button>
                <div id="amenities-section" class="toggle-section">
                    <label>Amenities (one per line):</label>
                    <textarea name="amenities"></textarea>
                </div>

                <button type="button" class="btn toggle-btn" onclick="toggleSection('video-section')">Add Video Tour</button>
                <div id="video-section" class="toggle-section">
                    <label>Video URL:</label>
                    <input type="url" name="video_url">
                </div>

                <button type="button" class="btn toggle-btn" onclick="toggleSection('map-section')">Add Map</button>
                <div id="map-section" class="toggle-section">
                    <label>Map URL:</label>
                    <input type="url" name="map_url">
                </div>

                <button type="button" class="btn toggle-btn" onclick="toggleSection('developers-section')">Add Developers</button>
                <div id="developers-section" class="toggle-section">
                    <label>Developers:</label>
                    <textarea name="developers"></textarea>
                </div>

                <button type="button" class="btn toggle-btn" onclick="toggleSection('testimonials-section')">Add Testimonials</button>
                <div id="testimonials-section" class="toggle-section">
                    <label>Testimonials (one per line):</label>
                    <textarea name="testimonials"></textarea>
                </div>

                <label>Images:</label>
                <input type="file" name="images[]" multiple accept="image/*" required>

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

                <input type="submit" value="Add Project" class="btn">
            </form>
        </div>

        <!-- Edit Project Form (hidden by default, shown when editing) -->
        <?php if ($edit_project): ?>
            <div class="form-section edit-form active">
                <h2>Edit Project: <?php echo htmlspecialchars($edit_project['title']); ?></h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $edit_project['id']; ?>">
                    <input type="hidden" name="edit_project" value="1">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($edit_project['title']); ?>" required>

                    <label>City:</label>
                    <select name="city" required>
                        <option value="Lahore" <?php echo $edit_project['city'] === 'Lahore' ? 'selected' : ''; ?>>Lahore</option>
                        <option value="Islamabad" <?php echo $edit_project['city'] === 'Islamabad' ? 'selected' : ''; ?>>Islamabad</option>
                        <option value="Sialkot" <?php echo $edit_project['city'] === 'Sialkot' ? 'selected' : ''; ?>>Sialkot</option>
                    </select>

                    <label>Location:</label>
                    <input type="text" name="location" value="<?php echo htmlspecialchars($edit_project['location']); ?>" required>

                    <label>Details:</label>
                    <textarea name="details" required><?php echo htmlspecialchars($edit_project['details']); ?></textarea>

                    <label>Description:</label>
                    <textarea name="description" required><?php echo htmlspecialchars($edit_project['description']); ?></textarea>

                    <button type="button" class="btn toggle-btn" onclick="toggleSection('edit-amenities-section')">Add Amenities</button>
                    <div id="edit-amenities-section" class="toggle-section">
                        <label>Amenities (one per line):</label>
                        <textarea name="amenities"><?php echo implode("\n", json_decode($edit_project['amenities'], true) ?: []); ?></textarea>
                    </div>

                    <button type="button" class="btn toggle-btn" onclick="toggleSection('edit-video-section')">Add Video Tour</button>
                    <div id="edit-video-section" class="toggle-section">
                        <label>Video URL:</label>
                        <input type="url" name="video_url" value="<?php echo htmlspecialchars($edit_project['video_url']); ?>">
                    </div>

                    <button type="button" class="btn toggle-btn" onclick="toggleSection('edit-map-section')">Add Map</button>
                    <div id="edit-map-section" class="toggle-section">
                        <label>Map URL:</label>
                        <input type="url" name="map_url" value="<?php echo htmlspecialchars($edit_project['map_url']); ?>">
                    </div>

                    <button type="button" class="btn toggle-btn" onclick="toggleSection('edit-developers-section')">Add Developers</button>
                    <div id="edit-developers-section" class="toggle-section">
                        <label>Developers:</label>
                        <textarea name="developers"><?php echo htmlspecialchars($edit_project['developers']); ?></textarea>
                    </div>

                    <button type="button" class="btn toggle-btn" onclick="toggleSection('edit-testimonials-section')">Add Testimonials</button>
                    <div id="edit-testimonials-section" class="toggle-section">
                        <label>Testimonials (one per line):</label>
                        <textarea name="testimonials"><?php echo implode("\n", json_decode($edit_project['testimonials'], true) ?: []); ?></textarea>
                    </div>

                    <label>Current Images:</label>
                    <?php if (!empty($edit_project['images'])): ?>
                        <div class="image-preview">
                            <?php foreach ($edit_project['images'] as $image): ?>
                                <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Project Image">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <label>Upload New Images:</label>
                    <input type="file" name="images[]" multiple accept="image/*">

                    <button type="button" class="btn toggle-btn" onclick="toggleSection('edit-pricing-section')">Add Pricing</button>
                    <div id="edit-pricing-section" class="toggle-section">
                        <label>Pricing:</label>
                        <div id="edit-pricing-container">
                            <?php if (!empty($edit_project['pricing'])): ?>
                                <?php foreach ($edit_project['pricing'] as $index => $pricing): ?>
                                    <div class="pricing-row">
                                        <input type="text" name="plot_size[]" value="<?php echo htmlspecialchars($pricing['plot_size']); ?>" placeholder="Plot Size">
                                        <input type="text" name="price[]" value="<?php echo htmlspecialchars($pricing['price']); ?>" placeholder="Price (PKR)">
                                        <input type="text" name="payment_plan[]" value="<?php echo htmlspecialchars($pricing['payment_plan']); ?>" placeholder="Payment Plan">
                                        <button type="button" onclick="this.parentElement.remove()">Remove</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="pricing-row">
                                    <input type="text" name="plot_size[]" placeholder="Plot Size">
                                    <input type="text" name="price[]" placeholder="Price (PKR)">
                                    <input type="text" name="payment_plan[]" placeholder="Payment Plan">
                                    <button type="button" onclick="this.parentElement.remove()">Remove</button>
                                </div>
                            <?php endif; ?>
                            <button type="button" onclick="addPricingRow('edit-pricing-container')">Add More</button>
                        </div>
                    </div>

                    <input type="submit" value="Update Project" class="btn">
                    <a href="manage-projects.php" class="btn btn-back">Cancel</a>
                </form>
            </div>
        <?php endif; ?>

        <!-- Projects Table -->
        <div class="form-section projects-table">
            <h2>Manage Projects</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>City</th>
                    <th>Actions</th>
                </tr>
                <?php while ($project = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $project['id']; ?></td>
                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                        <td><?php echo htmlspecialchars($project['city']); ?></td>
                        <td>
                            <a href="manage-projects.php?edit=1&id=<?php echo $project['id']; ?>" class="btn">Edit</a>
                            <a href="manage-projects.php?delete=1&id=<?php echo $project['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.classList.toggle('active');
        }

        function addPricingRow(containerId) {
            const container = document.getElementById(containerId || 'pricing-container');
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