<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>SECRET PAGE</h1>

<?php
session_start();
$name = $_GET["name"];
$pwd = $_GET["password"];
$_SESSION['username']=$name;
$_SESSION['password']=$pwd;

$_SESSION['AUTHENTICATED']="true";
echo "REGISTERED";
header('Location:secret.php');
?>

</body>

</html>
