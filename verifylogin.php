<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$user=$_REQUEST['user'];
$pass=$_REQUEST['pass'];
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790', 'id21168513_12596790', 'Rajitha@1975');
$stmt=$mydb->prepare("SELECT username,userpass ".
                    "from accounts ".
                    "where username=:user"
);
$stmt->execute([":user"=>$user]);
if($stmt->rowCount()==0)
    echo "false";
else{
    $result=$stmt->fetch(PDO::FETCH_OBJ);
    if (password_verify($pass,$result->userpass)){
        echo "true";
        $_SESSION['haslogin']='Y';
    }
    else
        echo "false";
}
?>