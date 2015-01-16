<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 * to insert weight
 */


$response = $fitbit->getTimeSeries("weight", "today", "1y");
$measurementName='weight';

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);

$array = $response;

//run through each weight value
for ($x = 0; $x < $arrayLenght; $x++) {

    $weight = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $weight);


    if (!$result) {

        $successfull = false;
    }

}


?>