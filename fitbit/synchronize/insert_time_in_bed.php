<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 17:22
 *
 * to insert time in bed
 *
 */


$response = $fitbit->getTimeSeries("timeInBed", "today", "1y");
$measurementName='timeInBed';
$timeInBedId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

//run through each time in bed value
for ($x = 0; $x < $arrayLength; $x++) {

    $timeInBed = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $timeInBed);


    if (!$result) {

        $successfull = false;
    }

}


?>