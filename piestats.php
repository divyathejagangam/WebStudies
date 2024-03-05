<?php
$stattype=$_REQUEST['stattype'];
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt=$mydb->prepare("select store, sum(stat) as sm ".
"from storestats ".
"where stattype=:stattype ".
"group by store ".
"order by store"
);
$stmt->bindParam("stattype",$stattype,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>