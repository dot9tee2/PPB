<?php
// db_connect.php
$host = 'localhost';
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password
$database = 'real_estate_new';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
