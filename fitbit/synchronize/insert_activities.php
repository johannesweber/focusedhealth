<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 01.12.14
 * Time: 16:49
 *
 * insert activities like swimming or running
 */


//date of today
$timestamp = time();
$datum = date("Y-m-d", $timestamp);

$error = true;


//Request for activities
$response = $fitbit->getActivities($datum);

//lenght of activity array
$arrayLenght = $response->activities;
$arrayLenght = sizeof($arrayLenght);
echo $arrayLenght;

//loop to insert all data from activity array
for ($x = 0; $x < $arrayLenght; $x++) {


    //access data of array
    $calories = $response->activities[$x]->calories;
    if (isset($response->activities[$x]->distance)){
        $distance = $response->activities[$x]->distance;
    }else{
        $distance = 0;
    };
    $description = $response->activities[$x]->description;
    $duration = $response->activities[$x]->duration;
    $lastModified = $response->activities[$x]->lastModified;
    $name = $response->activities[$x]->name;
    $startDate = $response->activities[$x]->startDate;
    $startTime = $response->activities[$x]->startTime;






$result = $db_connection->insertActivity($userId, $company, $calories, $distance, $description, $duration, $lastModified, $name, $startDate, $startTime);


if (!$result) {

    $successfull = false;
}

}

