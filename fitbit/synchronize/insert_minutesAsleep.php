<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 * to insert minutes asleep
 */


$response = $fitbit->getTimeSeries("minutesAsleep", "today", "1y");

$measurementName='minutesAsleep';

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);

// just to know its an array
$array = $response;

//run through each minutes asleep value
for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAsleep = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesAsleep);


    if (!$result) {

        $successfull = false;
    }

}


?>