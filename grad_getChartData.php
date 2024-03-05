<?php
error_reporting(E_ALL & ~E_NOTICE);

$byPopulation = $_REQUEST['byPopulation'];
$byContinent = $_REQUEST['byContinent'];
$selection = $_REQUEST['selection'];

$mydb = new PDO('mysql:host=localhost;dbname=id21168513_12596790','id21168513_12596790','Rajitha@1975');
if ($byContinent === 'true') {
    if ($byPopulation === 'true') {
        $stmt = $mydb->prepare("SELECT countryname, population AS stat FROM countries WHERE continentcode = :selection order by countryname");
    } else {
        $stmt = $mydb->prepare("SELECT countryname, landarea AS stat FROM countries WHERE continentcode = :selection order by countryname");
    }
} else {
    if ($byPopulation === 'true') {
        $stmt = $mydb->prepare("SELECT countries.countryname, population AS stat FROM countries INNER JOIN countryagreement ON countries.countryname = countryagreement.countryname WHERE agreecode = :selection ORDER BY countries.countryname");
    } else {
        $stmt = $mydb->prepare("SELECT countries.countryname, landarea AS stat FROM countries INNER JOIN countryagreement ON countries.countryname = countryagreement.countryname WHERE agreecode = :selection ORDER BY countries.countryname");
    }
}

$stmt->bindParam(':selection', $selection);
$stmt->execute();
$result = $stmt->fetchAll();

echo json_encode($result);
?>