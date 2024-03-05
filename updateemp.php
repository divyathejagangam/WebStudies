<?php
error_reporting(E_ALL & ~E_NOTICE);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$empid = $_REQUEST['empid'];
$empname = $_REQUEST['empname'];
$passcode = $_REQUEST['passcode'];
$passcode = password_hash($passcode,PASSWORD_BCRYPT);
$emptypecode = $_REQUEST['memtype'];
echo $emptypecode;
$stmt = $mydb->prepare("UPDATE employee SET empname = :empname, emppassword = :passcode,emptypecode = :emptypecode ".
                                 "WHERE empid = :empid");
$stmt->bindParam(':empid',$empid);
$stmt->bindParam(':empname',$empname);
$stmt->bindParam(':emptypecode',$emptypecode);
$stmt->bindParam(':passcode',$passcode);
$stmt ->execute();
$result=$stmt->fetchAll();
//echo var_dump($stmt->errorInfo());
echo "success";

?>