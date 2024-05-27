<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Divya1234';
$dbName = 'Ftracker';

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
