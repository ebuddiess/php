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
            $sql = "INSERT into books (Book_id,Book_Type,Status,MRP,Purchase_Price,Sale_Price,Supplier_ID,Purchase_Date)  values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] .  "','" . $column[7] . "')";        
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
                  alert('uploaded Successfully')
                  window.location = \"../../index.html\"
                  </script>";	
            }
    }
}

?>