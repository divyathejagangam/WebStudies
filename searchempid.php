<?php
error_reporting(E_ALL & ~E_NOTICE);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$empid = $_REQUEST['empid'];
$stmt = $mydb->prepare("SELECT empid,empname,emptypecode ".
                        "from employee ".
                        "WHERE empid=:empid "
                        );
$stmt->bindParam(':empid',$empid);
$stmt ->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>
