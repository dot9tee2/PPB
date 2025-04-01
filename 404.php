<?php
require_once 'includes/seo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Pakistan Properties and Builders</title>
    <meta name="description" content="The page you're looking for doesn't exist. Find your dream property in Pakistan's most desirable locations.">
    
    <?php
    outputCanonicalTag();
    outputMetaRobots(false, true); // Don't index 404 pages, but allow following links
    ?>
    
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        .error-container {
            text-align: center;
            padding: 50px 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #e74c3c;
            margin: 0;
            line-height: 1;
        }
        .error-message {
            font-size: 24px;
            color: #2c3e50;
            margin: 20px 0;
        }
        .error-description {
            color: #7f8c8d;
            margin-bottom: 30px;
        }
        .back-home {
            display: inline-block;
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-home:hover {
            background-color: #2980b9;
        }
        .suggested-links {
            margin-top: 40px;
            text-align: left;
        }
        .suggested-links h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .suggested-links ul {
            list-style: none;
            padding: 0;
        }
        .suggested-links li {
            margin-bottom: 10px;
        }
        .suggested-links a {
            color: #3498db;
            text-decoration: none;
        }
        .suggested-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="error-container">
        <h1 class="error-code">404</h1>
        <h2 class="error-message">Page Not Found</h2>
        <p class="error-description">
            We're sorry, but the page you're looking for doesn't exist or has been moved.
        </p>
        <a href="/" class="back-home">Back to Homepage</a>
        
        <div class="suggested-links">
            <h3>You might be interested in:</h3>
            <ul>
                <li><a href="/projects">View Our Projects</a></li>
                <li><a href="/services">Our Services</a></li>
                <li><a href="/blog">Read Our Blog</a></li>
                <li><a href="/contact">Contact Us</a></li>
            </ul>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html> 