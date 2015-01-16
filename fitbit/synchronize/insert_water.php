<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 *
 * to insert water
 */


$response = $fitbit->getTimeSeries("water", "today", "1y");

$measurementName='water';

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);

$array = $response;

//run through each water value
for ($x = 0; $x < $arrayLenght; $x++) {

    $water = $array[$x]->value;
    $date = $array[$x]->dateTime;

    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $water);


    if (!$result) {

        $successfull = false;
    }

}


?>