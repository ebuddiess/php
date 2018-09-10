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
$i=0;
if (mysqli_num_rows($result) <=0) {
echo "No Records Upload A Comparison file Please";
}else{    

    $sql = "SELECT books.Book_id AS BOOKID , books.Book_Type , books.Status , \n"
    . "books.MRP , books.Purchase_Price , books.Sale_Price , books.Supplier_ID , \n"
    . "books.Purchase_Date , currentdata.Book_id as CURRENT  \n"
    . "from books RIGHT OUTER JOIN currentdata on books.Book_id = currentdata.Book_id"; 
    $result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>INDEX</th><th>BOOK ID</th><th>Status</th>";
             while($row = mysqli_fetch_assoc($result)){
              if($row['CURRENT']!=""&&$row["BOOKID"]==""){
                $i=$i+1; 
                echo "<tr><td>".$i."</td><td>".$row['CURRENT']."</td><td>MISSING IN DATABASE</td></tr>";
             } 
            }
}
    
}    
?>