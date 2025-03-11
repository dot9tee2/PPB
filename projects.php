<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pakistan Properties and Builders - Projects</title>
    <link rel="icon" type="image/x-icon" href="media/favicon.ico">
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="animation.css" /> -->
</head>

<body>
    <div class="preloader">
        <div class="loader-container">
            <div class="loader"></div>
            <img src="media/logoFinal.png" alt="Company Logo">
        </div>
    </div>
    <a href="contact.php" class="sticky-cta">Contact Us Now</a>
    <?php include 'navbar.php'; ?>


    <section class="featured-listings animate-on-scroll">
        <h2>Featured Projects</h2>
        <div class="listings-grid">
            <div class="listing-card">
                <div class="image-container">
                    <img src="media/lahore.webp" alt="Lahore">
                </div>
                <div class="card-content">
                    <h3>Lahore</h3>
                    <a href="city_projects.php?city=Lahore" class="view-details">View Details</a>
                </div>
            </div>
            <div class="listing-card">
                <div class="image-container">
                    <img src="media/Islamabad.webp" alt="Islamabad">
                </div>
                <div class="card-content">
                    <h3>Islamabad</h3>
                    <a href="city_projects.php?city=Islamabad" class="view-details">View Details</a>
                </div>
            </div>
            <div class="listing-card">
                <div class="image-container">
                    <img src="media/Sialkot.webp" alt="Sialkot">
                </div>
                <div class="card-content">
                    <h3>Sialkot</h3>
                    <a href="city_projects.php?city=Sialkot" class="view-details">View Details</a>
                </div>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script type="module" src="js/main.js"></script>
</body>

</html>