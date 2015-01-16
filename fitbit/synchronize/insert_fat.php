<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:10
 *
 * to insert body fat
 */

// Request for fat to get a specific time series
$response = $fitbit->getTimeSeries("fat", "today", "1y");
$measurementName='bodyFat';

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

//run through each body fat value
for ($x = 0; $x < $arrayLenght; $x++) {

    $fat = $array[$x]->value;
    $date = $array[$x]->dateTime;

    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $fat);

    if (!$result) {

        $successfull = false;
    }

}


?>