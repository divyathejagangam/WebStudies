<?php
error_reporting(E_ALL & ~E_NOTICE);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt = $mydb->prepare("SELECT * FROM tradeagreement");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>