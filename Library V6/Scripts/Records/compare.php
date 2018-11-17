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
$sqlSelect = "SELECT * FROM currentdata";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) <=0) {
echo "No Records Upload A Comparison file Please";
}else{    

$sql = "SELECT books.Acc_no AS ACCNO , books.Title , books.Status , currentdata.Acc_no as CURRENT  \n"

    . "from books LEFT OUTER JOIN currentdata on books.Acc_no = currentdata.Acc_no";
    
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>INDEX</th><th>ACC NO</th>
             <th>BOOK TITLE</th>
             <th>CURRENT</th>
             <th>STATUS</th>";
    $i=0;
     while($row = mysqli_fetch_assoc($result)){
        $i=$i+1;     
         if($row['CURRENT']==''){
         echo "<tr style='background:red;color:white'><td>$i</td><td>".$row['ACCNO']."</td><td>".$row['Title']."</td>
         <td>".$row['ACCNO']."</td><td>MISSING</td>";       
         }else{
         echo "<tr style='background:#25cc62'><td>$i</td><td>".$row['ACCNO']."</td><td>".$row['Title']."</td>
         <td>".$row['CURRENT']."</td><td>IN STOCK</td>";  
         }
     }
    
     echo "</tbody></table></div>";

     
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}      
}
?>