<?php
include 'db_connect.php';

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

  // Insert into projects table
  $sql = "INSERT INTO projects (title, details, city, location, description, amenities, video_url, map_url, developers, testimonials) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssssss", $title, $details, $city, $location, $description, $amenities, $video_url, $map_url, $developers, $testimonials);
  $stmt->execute();
  $project_id = $conn->insert_id;

  // Handle image uploads
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

  // Handle pricing
  if (!empty($_POST['plot_size'])) {
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

// Fetch all projects
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Real Estate</title>
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
  </style>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="admin-container">
    <!-- Add Project Form -->
    <div class="form-section">
      <h2>Add New Project</h2>
      <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

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

        <input type="submit" name="add_project" value="Add Project" class="btn">
      </form>
    </div>

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
              <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="btn">Edit</a>
              <a href="admin.php?delete=<?php echo $project['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
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

<?php
// Handle project deletion
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $sql = "DELETE FROM projects WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  header("Location: admin.php");
  exit;
}
?>