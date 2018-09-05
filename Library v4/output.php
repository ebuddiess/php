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
$sql = "SELECT bookdata.bookcode  as BOOKCODE, currentdata.bookcode as CURRENT from bookdata LEFT OUTER JOIN currentdata on bookdata.bookcode = currentdata.bookcode where currentdata.bookcode is null and bookdata.status =\"stock\"";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>BOOK CODE</th>
                          <th>STATUS</th>
                        </tr></thead><tbody>"; 
     while($row = mysqli_fetch_assoc($result)){
     echo "<tr><td>".$row['BOOKCODE']."</td><td>NOT FOUND</td></tr>";                  
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}      
}
?>