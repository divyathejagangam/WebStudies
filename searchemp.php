<?php
error_reporting(E_ALL&~E_NOTICE);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$empname = $_REQUEST['empname'];
$stmt = $mydb->prepare("SELECT empname".
                        "from employee ".
                        "WHERE empname LIKE :empname ".
                        "order by empname"
                        );
$empname = '%' . $empname . '%'; 
$stmt->bindParam(':empname',$empname);
$stmt ->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>