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
$errorcheck = 0;
if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file,1000, ",")) !== FALSE) {
            $sql = "UPDATE `books` SET `Book_id`=\"$column[0]\" , 
`Book_Type`=\"$column[1]\" , 
`Status`=\"$column[2]\" ,
`MRP`=\"$column[3]\" , 
`Purchase_Price`=\"$column[4]\" ,
`Sale_Price`=\"$column[5]\" ,
`Supplier_ID`=\"$column[6]\" ,
`Purchase_Date`=\"$column[7]\" where `Book_id` = \"$column[0]\"";  
   $result = mysqli_query($conn, $sql);
            if(!$result){
                $errorcheck = 1;
                $output=mysqli_error($conn);
                echo "<h4>Error:$output</h4>";
            }
        }
        if($errorcheck==1){
            echo "<h4>Except error Uploaded Successfully</h4>";
        }
        fclose($file);
        if ((! empty($result)) && $errorcheck==0) {
             echo "<script type=\"text/javascript\">
                  alert('updated Successfully')
                  window.location = \"../../index.html\"
                  </script>";	
            }
    }
}

?>