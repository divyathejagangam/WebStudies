<?php
$store=$_REQUEST['store'];
$stattype=$_REQUEST['stattype'];
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt=$mydb->prepare("select stat ".
"from storestats ".
"where store=:store ".
"and stattype=:stattype ".
"order by storemonth"
);
$stmt->bindParam("store",$store,PDO::PARAM_INT);
$stmt->bindParam("stattype",$stattype,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>
