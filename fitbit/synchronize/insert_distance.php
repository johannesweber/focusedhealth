<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 15:17
 */



$response = $fitbit->getTimeSeries("distance", "today", "1y");
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


?>