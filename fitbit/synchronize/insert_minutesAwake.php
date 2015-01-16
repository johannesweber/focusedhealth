<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 * to insert minutes awake
 */


$response = $fitbit->getTimeSeries("minutesAwake", "today", "1y");
$measurementName='minutesAwake';

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);

// just to know it's an array
$array = $response;

//run through each minutes awake value
for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAwake = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesAwake);


    if (!$result) {

        $successfull = false;
    }

}


?>