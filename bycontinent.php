<?php
error_reporting(E_ALL & ~E_NOTICE);
$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790', 'id21168513_12596790', 'Rajitha@1975');

$continentCode = $_REQUEST['continent'];

if ($continentCode == 'All') {
    
    $stmt = $mydb->prepare("SELECT countries.countryname, countries.population, countries.landarea " .
        "FROM countries " .
        "ORDER BY countries.countryname");
} 
else {
 
    $stmt = $mydb->prepare("SELECT countries.countryname, countries.population, countries.landarea " .
        "FROM countries " .
        "INNER JOIN continents ON countries.continentcode = continents.continentcode " .
        "WHERE continents.continentcode = '$continentCode' " .
        "ORDER BY countries.countryname");
   
}
$stmt->execute();
$result = $stmt->fetchAll();

echo json_encode($result);
?>