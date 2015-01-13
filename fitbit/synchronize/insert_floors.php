<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 15:51
 */


$response = $fitbit->getTimeSeries("floors", "today", "1y");

$measurementName='floors';
$floorsId = $db_connection->getMeasurementId($measurementName);

$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $floors = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $floors);


    if (!$result) {

        $successfull = false;
    }

}


?>