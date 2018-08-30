<html>
<head>
<title>Library Management System</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<h1>LIBRARY MANAGEMENT SYSTEM</h1>
<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "library";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = 'SELECT bookdata.bookcode as BOOKDATA , currentdata.bookcode as CURRENTBOOK from bookdata LEFT OUTER JOIN currentdata on bookdata.bookcode = currentdata.bookcode where currentdata.bookcode is null and bookdata.status ="stock"';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         echo "<h3 style=margin:10px;'>".$row["BOOKDATA"]."</p>";                      
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
</body>    
</html>