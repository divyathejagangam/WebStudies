<?php 
error_reporting(E_ALL&~E_NOTICE);
$user=$_REQUEST ['user'];
$pass=password_hash($_REQUEST ['pass'],PASSWORD_BCRYPT);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt=$mydb->prepare ("Select username ".
"from accounts ".
"where username=:user"
);
$stmt->bindParam(":user", $user);
$stmt->execute();
if ($stmt->rowCount()==0)
$stmt=$mydb->prepare ("Insert into accounts (username, userpass) ".
"values (:user,:pass)"
);
else
$stmt=$mydb->prepare("Update accounts ".
"set userpass=:pass ".
"where username=:user"
);
$stmt->bindParam(":user",$user);
$stmt->bindParam(":pass",$pass);
$stmt->execute();
echo "executed";
?>