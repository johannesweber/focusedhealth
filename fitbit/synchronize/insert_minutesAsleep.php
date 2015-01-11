<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */

$successfull = true;

$response = $fitbit->getTimeSeries("minutesAsleep", "today", "7d");

$measurementName='minutesAsleep';
$minutesAsleepId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAsleep = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesAsleep);


    if (!$result) {

        $successfull = false;
    }

}

$fitbit->showSynchronizeMessage($successfull);

?>