<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 *
 * to insert the weekly goals
 */


$response = $fitbit->getActivityWeeklyGoals();

// to get the name for the measurement
$distanceMeasurementName = 'distance';
$stepsMeasurementName = 'steps';
$period = 'weekly';
$periodWeeklyId = $db_connection->getPeriodId($period);


$distance = $response->goals->distance;
$steps = $response->goals->steps;


// Array for the different measurements
$measArray[0] = $distanceMeasurementName;
$measArray[1] = $stepsMeasurementName;

// Array for the different measurement values
$werteArray[0] = $distance;
$werteArray[1] = $steps;

// run through each value
for ($id = 0; $id < sizeof($measArray); $id++) {

    $measurementName = $measArray[$id];
    $wert = $werteArray[$id];

    $result = $db_connection->insertGoal($userId, $company, $measurementName, $wert, $periodWeeklyId);


    if (!$result) {

        $successfull = false;
    }

}


?>
