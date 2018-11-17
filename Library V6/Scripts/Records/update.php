<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "library";

$bookid = $_GET['bookid'];
$bookstatus = $_GET['status'];
$mrp= $_GET['mrp'];
$type= $_GET['booktype'];
$purpr= $_GET['purchaseprice'];
$salepr= $_GET['saleprice'];
$supplid= $_GET['supplierid'];
$purcdate= $_GET['purchasedate'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE `books` SET `Book_id`=\"$bookid\" , 
`Book_Type`=\"$type\" , 
`Status`=\"$bookstatus\" ,
`MRP`=\"$mrp\" , 
`Purchase_Price`=\"$purpr\" ,
`Sale_Price`=\"$salepr\" ,
`Supplier_ID`=\"$supplid\" ,
`Purchase_Date`=\"$purcdate\" where `Book_id` = \"$bookid\"";    

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

?>
