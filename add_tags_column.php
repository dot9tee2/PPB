<?php
include 'db_connect.php';

// Add tags column if it doesn't exist
$sql = "ALTER TABLE blog_posts ADD COLUMN IF NOT EXISTS tags TEXT AFTER category";

if ($conn->query($sql) === TRUE) {
    echo "Tags column added successfully!";
} else {
    echo "Error adding tags column: " . $conn->error;
}

$conn->close();
?> 