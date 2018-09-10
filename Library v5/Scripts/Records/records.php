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

$sqlSelect = "SELECT * FROM books";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>index</th><th>BOOK ID</th>
                          <th>BOOK TYPE</th>
                          <th>STATUS</th>
                          <th>MRP</th>
                          <th>PURCHASE PRICE</th>
                          <th>SALE PRICE</th>
                          <th>SUPPLIER ID</th>
                          <th>PURCHASE DATE</th>
                          <th>MODIFY</th>
                        </tr></thead><tbody>"; 
    $i = 1; 
    while($row = mysqli_fetch_assoc($result)){
   
        echo "<tr><td>$i</td><td>".$row['Book_id']."</td><td>".$row['Book_Type']."</td>
        <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
        <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date']."</td><td>
        <div><li><i class='fas fa-pencil-alt' style='color:green;cursor:pointer' data-toggle='modal' data-target='#myModal' 
        data-bookid=".$row['Book_id']."
        data-bookstatus=".$row['Status']."
        data-booktype=".$row['Book_Type']."
        data-bookmrp=".$row['MRP']."
        data-bookpurchaseprice=".$row['Purchase_Price']."
        data-booksaleprice=".$row['Sale_Price']."
        data-booksupplierid=".$row['Supplier_ID']."
        data-bookpurchasedate=".$row['Purchase_Date']."
        onclick='data(this)'></i></li>
        <li><i class='fas fa-trash-alt' style='color:red;cursor:pointer' value=".$row['Book_id']." onclick='deleteRow(this)'></i></li>
        </td></tr>";
        $i=$i+1; 

    }
    
     echo "</tbody></table></div>";
     
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}
?>