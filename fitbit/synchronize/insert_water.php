<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 */


$response = $fitbit->getTimeSeries("water", "today", "7d");

$measurementName='water';
$waterId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $water = $array[$x]->value;
    $date = $array[$x]->dateTime;

    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $water);


    if (!$result) {

        $successfull = false;
    }

}


?>