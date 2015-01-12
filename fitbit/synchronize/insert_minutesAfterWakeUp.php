<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 19:08
 */


$successfull = true;

$response = $fitbit->getTimeSeries("minutesAfterWakeup", "today", "7d");

$measurementName='afterWakeUp';
$minutesminutesAfterWakeupId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAfterWakeup = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesAfterWakeup);


    if (!$result) {

        $successfull = false;
    }

}


?>