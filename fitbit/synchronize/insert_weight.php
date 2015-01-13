<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */


$response = $fitbit->getTimeSeries("weight", "today", "1y");
$measurementName='weight';
$weightId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);

$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $weight = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $weight);


    if (!$result) {

        $successfull = false;
    }

}


?>