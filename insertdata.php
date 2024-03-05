<?php
error_reporting(E_ALL & ~E_NOTICE);

function connectToDatabase() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=id21168513_12596790', 'id21168513_12596790', 'Rajitha@1975');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function getCountryByName($db, $countryname) {
    $stmt = $db->prepare("SELECT * FROM countries WHERE countryname = :name");
    $stmt->bindParam(':name', $countryname);
    $stmt->execute();
    return $stmt->fetch();
}

function updateCountry($db, $countryname, $population, $landarea, $continentcode, $tradeAgreements) {
    $existingCountry = getCountryByName($db, $countryname);

    if ($existingCountry) {
        updateExistingCountry($db, $countryname, $population, $landarea, $continentcode);
        echo "Country with name $countryname has been updated.";
    } else {
        insertNewCountry($db, $countryname, $population, $landarea, $continentcode);
        echo "Country inserted with name $countryname.";
    }

    deleteCountryAgreements($db, $countryname);
    insertCountryAgreements($db, $countryname, $tradeAgreements);
}

function updateExistingCountry($db, $countryname, $population, $landarea, $continentcode) {
    $stmt = $db->prepare("UPDATE countries SET population = :population, landarea = :area, continentcode = :continent  WHERE countryname = :name");
    $stmt->bindParam(':population', $population);
    $stmt->bindParam(':area', $landarea);
    $stmt->bindParam(':continent', $continentcode);
    $stmt->bindParam(':name', $countryname);
    $stmt->execute();
}

function insertNewCountry($db, $countryname, $population, $landarea, $continentcode) {
    $stmt = $db->prepare("INSERT INTO countries (countryname, population, landarea, continentcode) VALUES (:name, :population, :area, :continent)");
    $stmt->bindParam(':name', $countryname);
    $stmt->bindParam(':area', $landarea);
    $stmt->bindParam(':continent', $continentcode);
    $stmt->bindParam(':population', $population);
    $stmt->execute();
}

function deleteCountryAgreements($db, $countryname) {
    $stmt = $db->prepare("DELETE FROM countryagreement WHERE countryname = :name");
    $stmt->bindParam(':name', $countryname);
    $stmt->execute();
}

function insertCountryAgreements($db, $countryname, $tradeAgreements) {
    if (!empty($tradeAgreements)) {
        $stmt = $db->prepare("INSERT INTO countryagreement (countryname, agreecode) VALUES (:countryname, :agreecode)");
        $stmt->bindParam(':countryname', $countryname);

        foreach ($tradeAgreements as $code) {
            if (!empty($code)) {
                $stmt->bindParam(':agreecode', $code);
                $stmt->execute();
            }
        }
    }
}

$mydb = connectToDatabase();

$countryname = $_REQUEST['countryname'];
$population = $_REQUEST['population'];
$landarea = $_REQUEST['landarea'];
$continentcode = $_REQUEST['continentcode'];
$tradeAgreements = explode(',', $_REQUEST['tradeAgreements']);

updateCountry($mydb, $countryname, $population, $landarea, $continentcode, $tradeAgreements);
?>
