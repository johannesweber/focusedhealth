<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 *
 * to insert calories in goal
 */


$timestamp = time();
$date = date("Y-m-d", $timestamp);

$response = $fitbit->getFoodGoal();


// to get the Id's for the measurement name
$caloriesMeasurementName = 'caloriesIn';
$periodName = 'daily';


$foodGoal = $response->goals->calories;

//startdate is NULL because we are getting no startdate from Fitbit API
$result = $db_connection->insertGoal($userId, $company, $caloriesMeasurementName, $foodGoal, $periodName, $startdate = NULL);


if (!$result) {

    $successfull = false;
}




?>
