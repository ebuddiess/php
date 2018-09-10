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

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file,1000, ",")) !== FALSE) {
            $sql = "INSERT into currentdata (Book_id)  values ('" . $column[0] ."')";        
            $result = mysqli_query($conn, $sql);
        }
        fclose($file);
        if (! empty($result)) {
            echo "<script type=\"text/javascript\">
                  alert('uploaded Successfully')
                  window.location = \"../../index.html\"
                  </script>";	
            }else {
                echo "<h3>CSV ERROR : ".mysqli_error($conn)."</h3>";
                }
    }
}


?>