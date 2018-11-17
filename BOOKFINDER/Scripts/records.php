<?php
include "config.php";
$sql = "SELECT  * FROM bookfinder";
$result = mysqli_query($conn, $sql);
$data = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         $data[] = $row;
    }
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);
echo json_encode($data);

} else {
    echo "0 results";
}

mysqli_close($conn);
?>