<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:51
 *
 * insert calories in of a specific time range
 */


//Request for time series awakenings count
$response = $fitbit->getTimeSeries("caloriesIn", "today", "1y");

$measurementName='caloriesIn';
$caloriesId = $db_connection->getMeasurementId($measurementName);

//lenght of response array
$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


//just to know it's an array
$array = $response;

//loop to insert all data from response array
for ($x = 0; $x < $arrayLenght; $x++) {

//access data of array
    $caloriesIn = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $caloriesIn);


    if (!$result) {

        $successfull = false;
    }

}




?>