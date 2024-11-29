<?php
$host = 'localhost'; // Server
$user = 'root'; // Default username
$password = ''; // Leave empty for XAMPP/WAMP
$database = 'ecommerce'; // Database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$conn = new mysqli('localhost', 'root', '', 'ecommerce');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
   // echo "Database connected successfully!";
}
?>
