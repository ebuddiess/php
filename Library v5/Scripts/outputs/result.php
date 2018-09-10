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
$sql = "SELECT books.Book_id AS BOOKID , books.Book_Type , books.Status , \n"

    . "books.MRP , books.Purchase_Price , books.Sale_Price , books.Supplier_ID , \n"

    . "books.Purchase_Date , currentdata.Book_id as CURRENT  \n"

    . "from books LEFT OUTER JOIN currentdata on books.Book_id = currentdata.Book_id where currentdata.Book_id is null and books.Status = \"in-stock\"";

    $result = mysqli_query($conn, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>BOOK ID</th><th>BOOK TYPE</th>
                          <th>STATUS</th><th>CURRENT STATUS</th>
                        </tr></thead><tbody>"; 
     while($row = mysqli_fetch_assoc($result)){
     echo "<tr><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
     <td>".$row['Status']."</td><td>MISSING IN STOCK</td></tr>";                  
     $sum=$sum+1;
     }
    
     echo "</tbody></table></div>";
     echo "<h3>Total:".$sum."</h3>";
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}      
}
?>