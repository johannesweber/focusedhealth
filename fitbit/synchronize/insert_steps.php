<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 15:03
 *
 * to insert steps
 */


//date of today
$timestamp = time();
$today = date("Y-m-d", $timestamp);
$measurementName='steps';

// to get memberSince it's include in index; to get all data since the user is a member
$response = $fitbit->getTimeSeries("steps", $memberSince, $today);
$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

//run through each steps value
for ($x = 0; $x < $arrayLenght; $x++) {

    $steps = $array[$x]->value;
    $date = $array[$x]->dateTime;

    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $steps);

    if (!$result) {

        $successfull = false;
    }

}




?>