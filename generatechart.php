<?php

function connectToDatabase()
{
    $dbConnection = new PDO('mysql:host=localhost;dbname=id21168513_12596790', 'id21168513_12596790', 'Rajitha@1975');
    return $dbConnection;
}

function fetchData($db, $population, $continent, $value)
{
    if ($continent === 'true') {
        $query = $population === 'true' ?
            "SELECT countryname, population AS stat FROM countries WHERE continentcode = :value ORDER BY countryname" :
            "SELECT countryname, landarea AS stat FROM countries WHERE continentcode = :value ORDER BY countryname";
    } else {
        $query = $population === 'true' ?
            "SELECT countries.countryname, population AS stat FROM countries INNER JOIN countryagreement ON countries.countryname = countryagreement.countryname WHERE agreecode = :value ORDER BY countries.countryname" :
            "SELECT countries.countryname, landarea AS stat FROM countries INNER JOIN countryagreement ON countries.countryname = countryagreement.countryname WHERE agreecode = :value ORDER BY countries.countryname";
    }

    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $value);
    $stmt->execute();
    return $stmt->fetchAll();
}

$db = connectToDatabase();

$population = $_REQUEST['population'];
$continent = $_REQUEST['continent'];
$value = $_REQUEST['value'];

$result = fetchData($db, $population, $continent, $value);

echo json_encode($result);
?>