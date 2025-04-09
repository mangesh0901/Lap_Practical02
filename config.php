<?php
$servername = "localhost"; // XAMPP default
$username = "root"; // Default MySQL username
$password = ""; // Default (empty password)
$dbname = "contact_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
