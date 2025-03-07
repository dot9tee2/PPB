
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$conn = mysqli_connect('mysql.hostinger.com', 'u450586396_waqas', 'Waqas@0726', 'u450586396_PPB');
if ($conn) {
    echo "Connected successfully!";
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
?>  