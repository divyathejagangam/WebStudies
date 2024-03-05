<?php
error_reporting(E_ALL&~E_NOTICE);
$user = $_REQUEST['user'];
$mydb=new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt=$mydb->prepare ("Select username ".
"from accounts ".
"where username=:user"
);
$stmt->execute([":user"=>$user]);
if($stmt->rowCount()==0)
    echo "false";
else
    echo "true";
?>