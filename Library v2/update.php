<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "library";

$column = $_GET['column'];
$value = $_GET['value'];
$condition = $_GET['condition'];
    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "";
if($condition==1){
$sql = "UPDATE `bookdata` SET `bookcode`=\"$value\" where `bookcode` = \"$column\"";    
}
else if($condition==2){
    $sql = "UPDATE `bookdata` SET `status`=\"$value\" where `bookcode` = \"$column\"";    
}

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
