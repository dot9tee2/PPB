<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // If not logged in, show login form
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Hardcoded credentials (replace with your own)
    $valid_username = 'Waqas';
    $valid_password = 'Waqas@0726'; // Change this to a strong password

    if ($username === $valid_username && $password === $valid_password) {
      $_SESSION['logged_in'] = true;
    } else {
      $error = "Invalid username or password!";
    }
  }

  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin Login</title>
      <link rel="stylesheet" href="css/base.css">
      <style>
        .login-container {
          max-width: 400px;
          margin: 100px auto;
          padding: var(--spacing-lg);
          background: #fff;
          border-radius: 5px;
          box-shadow: var(--shadow);
        }

        .login-container h2 {
          margin-bottom: var(--spacing-md);
        }

        .login-container label {
          display: block;
          margin: var(--spacing-sm) 0 5px;
          font-weight: 600;
        }

        .login-container input {
          width: 100%;
          padding: 8px;
          margin-bottom: var(--spacing-md);
          border: 1px solid var(--light-gray);
          border-radius: 5px;
        }

        .error {
          color: #d9534f;
          margin-bottom: var(--spacing-md);
        }
      </style>
    </head>

    <body>
      <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
          <label>Username:</label>
          <input type="text" name="username" required>
          <label>Password:</label>
          <input type="password" name="password" required>
          <input type="submit" name="login" value="Login" class="btn">
        </form>
      </div>
    </body>

    </html>
<?php
    exit;
  }
}

include 'db_connect.php';

// Handle logout
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: " . basename(__FILE__));
  exit;
}
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

    .dashboard-sections {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--spacing-lg);
    }

    .dashboard-section {
      background: #fff;
      padding: var(--spacing-lg);
      border-radius: 5px;
      box-shadow: var(--shadow);
      text-align: center;
    }

    .dashboard-section h2 {
      color: var(--dark-green);
      margin-bottom: var(--spacing-md);
    }

    .dashboard-section p {
      margin-bottom: var(--spacing-md);
      color: #333;
    }

    .logout-btn {
      float: right;
      margin: var(--spacing-md);
    }

    @media (max-width: 768px) {
      .dashboard-sections {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="admin-container">
    <a href="?logout" class="btn logout-btn">Logout</a>

    <!-- Dashboard Sections -->
    <div class="dashboard-sections">
      <!-- Projects Section -->
      <div class="dashboard-section">
        <h2>Manage Projects</h2>
        <p>Add, edit, or delete real estate projects on your website.</p>
        <a href="manage-projects.php" class="btn">Go to Projects</a>
      </div>

      <!-- Blogs Section -->
      <div class="dashboard-section">
        <h2>Manage Blogs</h2>
        <p>Create, edit, or delete blog posts to engage your audience.</p>
        <a href="manage-blogs.php" class="btn">Go to Blogs</a>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>