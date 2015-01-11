<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 15:03
 */

$successfull = true;

//date of today
$timestamp = time();
$today = date("Y-m-d", $timestamp);
$measurementName='steps';
$stepsId = $db_connection->getMeasurementId($measurementName);



//memberSince include in index: find_member_since
$response = $fitbit->getTimeSeries("steps", $memberSince, $today);
$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;


for ($x = 0; $x < $arrayLenght; $x++) {

    $steps = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $steps);


    if (!$result) {

        $successfull = false;
    }

}

$fitbit->showSynchronizeMessage($successfull);



?>