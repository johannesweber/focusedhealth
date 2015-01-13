<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 19:08
 *
 * to insert minutes after wakeup
 */


$successfull = true;

$response = $fitbit->getTimeSeries("minutesAfterWakeup", "today", "1y");

$measurementName='afterWakeUp';
$minutesminutesAfterWakeupId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);

// just to know it's an array
$array = $response;

//run through each minutes after wakeup value
for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAfterWakeup = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesAfterWakeup);


    if (!$result) {

        $successfull = false;
    }

}


?>