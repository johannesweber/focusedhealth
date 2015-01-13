<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 *
 * to insert water goal
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');


//date for daily goal
$timestamp = time();
$date = date("Y-m-d", $timestamp);

$response = $fitbit->getWaterGoal();
$waterGoal = $response->goal->goal;

// to get the Id's for the measurement name
$waterMeasurementName='water';
$periodName='daily';
$periodDailyId = $db_connection->getPeriodId($periodName);

$result = $db_connection->insertGoal($userId, $company, $waterMeasurementName, $waterGoal, $periodDailyId);


if (!$result) {

    $successfull = false;
}




?>