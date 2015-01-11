<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 15:17
 */


$successfull = true;

$response = $fitbit->getTimeSeries("distance", "today", "7d");
print_r($response);
$measurementName='distance';
$distanceId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $distance = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $distance);


    if (!$result) {

        $successfull = false;
    }

}

$fitbit->showSynchronizeMessage($successfull);

?>