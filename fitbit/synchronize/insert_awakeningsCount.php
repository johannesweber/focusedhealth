<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 *insert awakenings count of a specific time range
 */



//Request for time series awakenings count
$response = $fitbit->getTimeSeries("awakeningsCount", "today", "1y");

$measurementName='awakeningsCount';
$awakeningsCountId = $db_connection->getMeasurementId($measurementName);

//length of response array
$arrayLength = $response;
$arrayLength = sizeof($arrayLength);


$array = $response;

//loop to insert all data from response array
for ($x = 0; $x < $arrayLength; $x++) {

    $awakeningsCount = $array[$x]->value;
    $date = $array[$x]->dateTime;


    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $awakeningsCount);


    if (!$result) {

        $successfull = false;
    }

}



?>

