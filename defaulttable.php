<?php
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
$stmt = $mydb->prepare("SELECT countryname, population, landarea ".
                        "from countries ".
                        "order by countryname"
                        );
$stmt ->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>

