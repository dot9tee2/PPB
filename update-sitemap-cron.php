<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'sitemap_cron.log');

// Include the sitemap generator
require_once 'improved-sitemap-generator.php';

try {
    // Connect to database
    require_once 'db_connect.php';
    
    // Set the base URL
    $baseURL = 'https://www.pakistanpropertiesandbuilders.com';
    
    // Create generator instance
    $generator = new ImprovedSitemapGenerator($conn, $baseURL);
    
    // Generate sitemap
    $success = $generator->generate();
    
    if ($success) {
        error_log("Sitemap updated successfully at " . date('Y-m-d H:i:s'));
    } else {
        error_log("Failed to update sitemap at " . date('Y-m-d H:i:s'));
    }
} catch (Exception $e) {
    error_log("Error in sitemap cron: " . $e->getMessage());
} 