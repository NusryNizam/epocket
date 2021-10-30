<?php
$servername = "localhost";
$username = "nusry";
$password = "Password@1"; 
$dbname = "epocket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>

