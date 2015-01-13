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
$periodDailyId = $db_connection->getPeriodId($periodName);


$foodGoal = $response->goals->calories;


$result = $db_connection->insertGoal($userId, $company, $caloriesMeasurementName, $foodGoal, $periodDailyId);


if (!$result) {

    $successfull = false;
}




?>
