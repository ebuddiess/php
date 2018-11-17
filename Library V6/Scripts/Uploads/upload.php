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
        $i = 1;
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file,1000, ",")) !== FALSE) {
            $Title =  mysqli_real_escape_string($conn,$column[1]);
            $Author =  mysqli_real_escape_string($conn,$column[3]);
            $sql = "INSERT into books (Acc_no,Title,Call_no,Author,Entry_date,Status)  VALUES ('" . $column[0] . "','" . $Title . "','" . $column[2] . "','" . $Author . "','" . $column[4] . "','" . $column[5] . "')";        
            $result = mysqli_query($conn, $sql);
            echo "line .$i.";            
            if(!$result){
                $errorcheck = 1;
                $output=mysqli_error($conn);
                echo "<h4>Error:$output</h4>";
            }
            $i++;
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
