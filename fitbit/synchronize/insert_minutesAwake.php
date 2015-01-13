<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */


$response = $fitbit->getTimeSeries("minutesAwake", "today", "1y");
$measurementName='minutesAwake';
$minutesAwakeId = $db_connection->getMeasurementId($measurementName);

$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

for ($x = 0; $x < $arrayLength; $x++) {

    $minutesAwake = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $minutesAwake);


    if (!$result) {

        $successfull = false;
    }

}


?>