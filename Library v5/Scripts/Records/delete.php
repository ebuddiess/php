<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "library";

$column = $_GET['value'];
    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM `books` WHERE `Book_id`=\"$column\"";    

if ($conn->query($sql) === TRUE) {
    echo "Record Deleted successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
