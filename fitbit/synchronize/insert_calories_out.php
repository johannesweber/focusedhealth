<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 14:24
 *
 * insert calories out
 */

// Request for time series awakenings count
$response = $fitbit->getTimeSeries("caloriesOut", "today", "1y");

//name of the measurement
$measurementName='caloriesOut';

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);

// just to know it's an array
$array = $response;

//run through all calories out values
for ($x = 0; $x < $arrayLenght; $x++) {

    $calories = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $calories);


    if (!$result) {

        $successfull = false;
    }

}


?>