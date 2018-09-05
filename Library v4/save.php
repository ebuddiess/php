<?php
$servername = "localhost";
$username = "puneet";
$password = "123456";
$dbname = "library";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["Export"])){
      $sqlSelect = "SELECT * FROM currentdata";
    $result = mysqli_query($con, $sqlSelect);
    if (mysqli_num_rows($result) <=0) {
 echo "No Records Upload A Comparison file Please";
}else{		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output,array('BOOKCODE','STATUS','CURRENT STATUS')); 
      $sql = "SELECT bookdata.bookcode as BOOKCODE , bookdata.status as STATUS , currentdata.bookcode as CURRENT from bookdata LEFT OUTER JOIN currentdata on bookdata.bookcode = currentdata.bookcode";
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_assoc($result))  
      {    if($row['STATUS']=='sale'){
             $row['CURRENT']='SOLD';
            }else if($row['CURRENT']==''){
                     $row['CURRENT']='NOT FOUND';
            }
            else if($row['STATUS']=='stock'){
                       $row['CURRENT']='Available';
            }
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }}  
?>