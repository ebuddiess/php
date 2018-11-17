<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "bookfinder";
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>