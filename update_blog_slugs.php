<?php
include 'db_connect.php';

// Add slug column if it doesn't exist
$sql = "ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS slug VARCHAR(255) AFTER title";
$conn->query($sql);

// Function to generate URL-friendly slug
function generateSlug($title) {
    // Convert to lowercase
    $slug = strtolower($title);
    
    // Replace spaces with hyphens
    $slug = str_replace(' ', '-', $slug);
    
    // Remove any character that isn't a letter, number, or hyphen
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
    
    // Remove multiple consecutive hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    
    // Trim hyphens from start and end
    $slug = trim($slug, '-');
    
    return $slug;
}

// Get all blog posts
$sql = "SELECT id, title FROM blog_posts WHERE slug IS NULL OR slug = ''";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $slug = generateSlug($row['title']);
    
    // Check if slug already exists
    $check_sql = "SELECT COUNT(*) as count FROM blog_posts WHERE slug = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $slug);
    $check_stmt->execute();
    $count = $check_stmt->get_result()->fetch_assoc()['count'];
    
    // If slug exists, append a number
    if ($count > 0) {
        $slug .= '-' . ($count + 1);
    }
    
    // Update the post with the new slug
    $update_sql = "UPDATE blog_posts SET slug = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $slug, $row['id']);
    $update_stmt->execute();
    
    echo "Updated slug for post ID {$row['id']}: {$slug}\n";
}

echo "Slug update completed successfully!";
$conn->close();
?> 