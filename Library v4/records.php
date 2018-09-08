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

$sqlSelect = "SELECT * FROM bookdata";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>index</th><th>BOOK CODE</th>
                          <th>STATUS</th>
                        </tr></thead><tbody>"; 
    $i = 1; 
    while($row = mysqli_fetch_assoc($result)){
   
        echo "<tr><td>$i</td><td><ul>" .$row['bookcode']."<li class='changemode'><input type='radio' name='status' 
        onclick='update(this.value,1)' value=".$row['bookcode'].">MODIFY</li><li class='changemode'><input type='radio' name='status' onclick='deleteRow(this.value)' value=".$row['bookcode'].">DELETE</li></ul></td>
        <td><ul>" . $row['status']."<li class='changemode'><input type='radio' name='status' onclick='update(this.value,2)' value=".$row['bookcode'].">MODIFY</li></ul></td>";          
    
        $i=$i+1; 
    }
    
     echo "</tbody></table></div>";
     
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}
?>