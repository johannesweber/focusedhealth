<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 * to insert minutes to fall asleep
 */


$response = $fitbit->getTimeSeries("minutesToFallAsleep", "today", "1y");

$measurementName='minutesToFallAsleep';
$minutesToFallAsleepId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

//run through each minutes to fall asleep value
for ($x = 0; $x < $arrayLength; $x++) {

    $minutesToFallAsleep = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesToFallAsleep);


    if (!$result) {

        $successfull = false;
    }

}


?>