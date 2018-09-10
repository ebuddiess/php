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

$sql = "DELETE FROM books";

if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'><strong>Record</strong> Deleted Sucesfully</div>";

} else {
            echo "<div class='alert alert-danger'><strong>Error</strong>Deleting Record</div>";
}

?>