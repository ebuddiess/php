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

$sql = "SELECT books.Book_id AS BOOKID , books.Book_Type , books.Status , 
books.MRP , books.Purchase_Price , books.Sale_Price , books.Supplier_ID , 
books.Purchase_Date , currentdata.Book_id as CURRENT  
from books LEFT OUTER JOIN currentdata on books.Book_id = currentdata.Book_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>INDEX</th><th>BOOK ID</th>
             <th>BOOK TYPE</th>
             <th>STATUS</th>
             <th>MRP</th>
             <th>PURCHASE PRICE</th>
             <th>SALE PRICE</th>
             <th>SUPPLIER ID</th>
             <th>PURCHASE DATE</th><th>CURRENT STATUS</th>";
    $i=0;
    $missingstock=0;
    $incorrectEntry=0;
    $sold=0;
    $s4correction=0;
    $sentassample=0;
    $available = 0;
     while($row = mysqli_fetch_assoc($result)){
        $i=$i+1;     
        if($row['Status']=="Sold" && $row['CURRENT']==""){
            $sold  =$sold+1;
            echo "<tr style='background:#25cc62'><td>$i</td><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
            <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
            <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date'].
            "</td><td>".$row['Status']."</td>";              
        }else if($row['Status']=="Sent-As-Sample" && $row['CURRENT']=="" ){
           $sentassample = $sentassample+1;
            echo "<tr><td>$i</td><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
            <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
            <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date'].
            "</td><td>".$row['Status']."</td>";    
        }else if($row['Status']=="Sent-4-Correction" && $row['CURRENT']=="" ){
            $s4correction = $s4correction+1;
            echo "<tr style='background:#FF9900'><td>$i</td><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
            <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
            <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date'].
            "</td><td>".$row['Status']."</td>";    
        }else if($row['Status']=="In-Stock" && $row['CURRENT']=="" ){
            $missingstock = $missingstock+1;
            echo "<tr style='background:#ffb2b2;'><td>$i</td><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
            <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
            <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date'].
            "</td><td>Missing in Stock</td>";    
        }else if($row['Status']=="Sold" && !$row['CURRENT']=="" ){
            $incorrectEntry = $incorrectEntry+1;
            echo "<tr style='background:#ffb2b2;'><td>$i</td><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
            <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
            <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date'].
            "</td><td>Sold Book Inside Database</td>";  
        }else{
            $available = $available+1;
            echo "<tr style='background:#00FFFF'><td>$i</td><td>".$row['BOOKID']."</td><td>".$row['Book_Type']."</td>
            <td>".$row['Status']."</td><td>".$row['MRP']."</td><td>".$row['Purchase_Price']."</td>
            <td>".$row['Sale_Price']."</td><td>".$row['Supplier_ID']."</td><td>".$row['Purchase_Date'].
            "</td><td>".$row['Status']."</td>";
        }
     }
    
     echo "</tbody></table></div>";
     echo "<ul style='margin-left:20px'>
           <li>Sent-As -Sample:$sentassample</li>
           <li>Sent Four Correction:$s4correction</li>
           <li>Missing Stock:$missingstock</li>
           <li>Sold Items:$sold</li>
           <li>Incorrect Entry:$incorrectEntry</li>
           <li>Available:$available</li>
           <li>Total:$i</li>
           </ul>";
     
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}      
}
?>