<?php
session_start();
if ($_SESSION['AUTHENTICATED']=='true'){
    
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    echo $username , $password;
}else{
header('Location:index.html');
echo "Login First";
}
?>