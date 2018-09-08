<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "library";

$column = $_GET['column'];
    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM `bookdata` WHERE `bookcode`=\"$column\"";    

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
