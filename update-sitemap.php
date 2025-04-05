<?php
// This script updates the sitemap.xml file by calling generate-sitemap.php
// and saving the output to sitemap.xml

// Get the content from generate-sitemap.php
$sitemap_content = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/generate-sitemap.php');

// Save the content to sitemap.xml
file_put_contents('sitemap.xml', $sitemap_content);

// Log the update
$log_file = 'sitemap-update.log';
$timestamp = date('Y-m-d H:i:s');
$log_entry = "$timestamp: Sitemap updated successfully\n";
file_put_contents($log_file, $log_entry, FILE_APPEND);

echo "Sitemap updated successfully at $timestamp";
?> 