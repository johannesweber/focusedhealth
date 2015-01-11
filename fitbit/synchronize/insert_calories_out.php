<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 14:24
 */

$successfull = true;

$response = $fitbit->getTimeSeries("caloriesOut", "today", "7d");

$measurementName='caloriesOut';
$caloriesOutId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $calories = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $calories);


    if (!$result) {

        $successfull = false;
    }

}

$fitbit->showSynchronizeMessage($successfull);

?>