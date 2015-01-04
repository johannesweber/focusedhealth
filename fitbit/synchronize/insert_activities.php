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


//loop to insert all data from activity array
for ($x = 0; $x < $arrayLenght; $x++) {

    //access data of array
    $calories = $response->activities[$x]->calories;
    $distance = $response->activities[$x]->distance;
    $description = $response->activities[$x]->description;
    $duration = $response->activities[$x]->duration;
    $lastModified = $response->activities[$x]->lastModified;
    $name = $response->activities[$x]->name;
    $startDate = $response->activities[$x]->startDate;
    $startTime = $response->activities[$x]->startTime;


    //SQL Statement to check if this data set already exists for this day
    $select = "SELECT * FROM activity WHERE user_id='$userId' AND activity='$name' AND company_id='$company_id' AND date= '$startDate' AND start_time= '$startTime' ";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }

    $rowCount = $result->num_rows;

    //activity was not inserted today
    if ($rowCount == 0) {

        $insert = "INSERT INTO activity (user_id, company_id, activity, date, start_time, duration, distance, calories, description, last_modified)
                VALUES ('$userId', '$company_id', '$name', '$startDate', '$startTime', '$duration', '$distance', '$calories', '$description', '$lastModified')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }
    }

}