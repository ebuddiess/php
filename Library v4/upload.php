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
}else{
    echo "connected Sucessfully";
}

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file,1000, ",")) !== FALSE) {
                        $sqlInsert = "INSERT into bookdata values ('" . $column[0] . "','" . $column[1] . "')";
                        $result = mysqli_query($conn, $sqlInsert);
        }
        fclose($fileName);
                 if (! empty($result)) {
                        echo "<script type=\"text/javascript\">
							  alert('uploaded Sucessfully')
                              window.location = \"index.html\"
						      </script>";	
                        }else {
                        echo "<script type=\"text/javascript\">
							  alert('Something Wrong With CSV File')
                              window.location = \"index.html\"
						      </script>";	
                            }
    }
}

?>