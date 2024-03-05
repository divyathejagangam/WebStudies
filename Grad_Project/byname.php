<?php
error_reporting(E_ALL & ~E_NOTICE);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790', 'id21168513_12596790', 'Rajitha@1975');

$countryname = $_REQUEST['countryname'];

if (strlen($countryname) == 0) {
    // $stmt = $mydb->prepare("SELECT countryname, population, landarea " .
    //     "FROM countries " .
    //     "ORDER BY countryname");
    $result = [];
} 
else {
    $stmt = $mydb->prepare("SELECT countryname " .
        "FROM countries " .
        "WHERE countryname LIKE :countryname " .
        "ORDER BY countryname");
    $countryname = '%' . $countryname . '%'; 
   $stmt->bindParam(':countryname', $countryname);
}

$stmt->execute();
$result = $stmt->fetchAll();
echo json_encode($result);
?>