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


// icluding all files which are necessary to get the ids
include '../id/find_company_id.php';


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
    $select_weight = "SELECT * FROM activity WHERE user_id='$userId' AND activity='$name' AND company_id='$company_id' AND date= '$startDate' AND start_time= '$startTime' ";
    $result = $db_connection->executeStatement($select_weight);
    $rowCount = $result->num_rows;

    //activity was not inserted today
    if ($rowCount == 0 ) {

    $insert_activity = "INSERT INTO activity (user_id, company_id, activity, date, start_time, duration, distance, calories, description, last_modified)
                VALUES ('$userId', '$company_id', '$name', '$startDate', '$startTime', '$duration', '$distance', '$calories', '$description', '$lastModified')";

    $db_connection->executeStatement($insert_activity);


    }

}
