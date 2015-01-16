<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 *
 * to insert water goal
 */

// For Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'On');


//date for daily goal
$timestamp = time();
$date = date("Y-m-d", $timestamp);

$response = $fitbit->getWaterGoal();
$waterGoal = $response->goal->goal;

// to get the name for the measurement
$waterMeasurementName='water';
$periodName='daily';

//startdate is NULL because we are getting no startdate from Fitbit API
$result = $db_connection->insertGoal($userId, $company, $waterMeasurementName, $waterGoal, $periodName, $startdate = NULL);


if (!$result) {

    $successfull = false;
}




?>