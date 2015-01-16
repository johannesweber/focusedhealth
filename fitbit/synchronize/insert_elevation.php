<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:04
 *
 * to insert elevation values
 */

//Request for elevation to get specific time series
$response = $fitbit->getTimeSeries("elevation", "today", "1y");
$measurementName='elevation';

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

//run through each elvevation value
for ($x = 0; $x < $arrayLenght; $x++) {

    $elevation = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $elevation);


    if (!$result) {

        $successfull = false;
    }

}


?>