<?php
// Include database connection
include 'db_connect.php';

// Set the content type to XML
header('Content-Type: application/xml; charset=utf-8');

// Start the XML document
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="sitemap.xsl"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

// Base URL
$base_url = 'https://pakistanpropertiesandbuilders.com';

// Main Pages
$main_pages = [
    ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
    ['url' => '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['url' => '/services', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['url' => '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['url' => '/projects', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['url' => '/blog', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['url' => '/details', 'priority' => '0.8', 'changefreq' => 'daily']
];

// Output main pages
foreach ($main_pages as $page) {
    echo '<url>';
    echo '<loc>' . $base_url . $page['url'] . '</loc>';
    echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
    echo '<changefreq>' . $page['changefreq'] . '</changefreq>';
    echo '<priority>' . $page['priority'] . '</priority>';
    echo '</url>';
}

// Project categories
$project_categories = ['Islamabad', 'Lahore', 'Sialkot'];
foreach ($project_categories as $category) {
    echo '<url>';
    echo '<loc>' . $base_url . '/projects/' . $category . '</loc>';
    echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
    echo '<changefreq>weekly</changefreq>';
    echo '<priority>0.8</priority>';
    echo '</url>';
}

// Blog categories
$blog_categories = ['real-estate-tips', 'market-updates', 'investment-guides'];
foreach ($blog_categories as $category) {
    echo '<url>';
    echo '<loc>' . $base_url . '/blog/category/' . $category . '</loc>';
    echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
    echo '<changefreq>weekly</changefreq>';
    echo '<priority>0.6</priority>';
    echo '</url>';
}

// Blog posts
$sql = "SELECT slug, publish_date FROM blog_posts ORDER BY publish_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<url>';
        echo '<loc>' . $base_url . '/blog/' . htmlspecialchars($row['slug']) . '</loc>';
        echo '<lastmod>' . date('Y-m-d', strtotime($row['publish_date'])) . '</lastmod>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>0.6</priority>';
        echo '</url>';
    }
}

// Close the XML document
echo '</urlset>';
?> 