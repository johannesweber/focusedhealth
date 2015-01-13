<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:10
 */


$response = $fitbit->getTimeSeries("fat", "today", "1y");
$measurementName='bodyFat';
$fatId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $fat = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $fat);


    if (!$result) {

        $successfull = false;
    }

}


?>