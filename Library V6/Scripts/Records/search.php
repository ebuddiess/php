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

$searchvalue =$_GET['value'];

$sql = "SELECT * FROM `books` WHERE books.Acc_no LIKE \"%$searchvalue%\" or books.Title LIKE \"%$searchvalue%\" or books.Status LIKE \"%$searchvalue%\"";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead class='thead-dark'><tr><th>ACC NO</th>
             <th>BOOK Title</th>
             <th>Call no</th>
             <th>Author</th>
             <th>Entry Date</th>
             <th>Status</th>
             <th>MODIFY</th>
           </tr></thead><tbody>"; 
     while($row = mysqli_fetch_assoc($result)){
    
        echo "<tr><td>".$row['Acc_no']."</td><td>".$row['Title']."</td>
        <td>".$row['Call_no']."</td><td>".$row['Author']."</td><td>".$row['Entry_date']."</td>
        <td>".$row['Status']."</td><td>
        <div><li><i class='fas fa-pencil-alt' style='color:green;cursor:pointer' data-toggle='modal' data-target='#myModal' 
        data-bookid=".$row['Acc_no']."
        onclick='data(this)'></i></li>
        <li><i class='fas fa-trash-alt' style='color:red;cursor:pointer' value=".$row['Acc_no']." onclick='deleteRow(this)'></i></li>
        </td></tr>";

     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "<div class='alert alert-danger'><strong>Sorry</strong> You Dont Have Any records </div>";
}
?>