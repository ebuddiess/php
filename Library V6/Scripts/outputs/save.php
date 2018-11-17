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
      fputcsv($output,array('ACCOUNTNO','BOOKTITLE','CURRENT','STATUS')); 
      $sql = "SELECT books.Acc_no AS ACCNO , books.Title , currentdata.Acc_no as CURRENT , books.Status   \n"
    . "from books LEFT OUTER JOIN currentdata on books.Acc_no = currentdata.Acc_no";
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_assoc($result))  
      {    
         if($row['CURRENT']==NULL){
            $row['CURRENT']=$row['ACCNO'];
            $row['Status']="MISSING";
            $row = array($row['ACCNO'],$row['Title'],$row['CURRENT'],$row['Status']);
            fputcsv($output,$row); 
         }        
      }
    }  
      fclose($output);  
 }  
?>