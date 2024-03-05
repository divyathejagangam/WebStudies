<?php
error_reporting(E_ALL & ~E_NOTICE);

$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790', 'id21168513_12596790', 'Rajitha@1975');


$countryname = $_REQUEST['countryname'];
$result = [];

if (strlen($countryname) == 0) {
    echo json_encode($result);
    exit;
}


    $stmt = $mydb->prepare("SELECT countries.countryname, countries.population, countries.landarea, continents.continentname " .
                          "FROM countries " .
                          "JOIN continents ON countries.continentcode = continents.continentcode " .
                          "WHERE countries.countryname = :countryname " .
                          "ORDER BY countries.countryname");

    $stmt->bindParam(':countryname', $countryname);
    $stmt->execute();
    $result = $stmt->fetchAll();


echo json_encode($result);
?>
