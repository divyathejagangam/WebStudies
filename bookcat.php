<?php
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt = $mydb->prepare("SELECT category_code,category_name ".
                        "from bookcat ".
                        "order by category_name"
                        );
$stmt->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>