<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 *
 * insert bmi of a specific time range
 *
 */


//Request for time series awakenings count
$response = $fitbit->getTimeSeries("bmi", "today", "1y");
$measurementName='bmi';
$bmiId = $db_connection->getMeasurementId($measurementName);



//lenght of response array
$arrayLength = $response;
$arrayLength = sizeof($arrayLength);

// just to know it's an array
$array = $response;

//loop to insert all data from response array
for ($x = 0; $x < $arrayLength; $x++) {

    //access data of array
    $bmi = $array[$x]->value;
    $date = $array[$x]->dateTime;

    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $bmi);


    if (!$result) {

        $successfull = false;
    }

}


?>