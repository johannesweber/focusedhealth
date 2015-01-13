<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 *
 * to insert the daily goals
 *
 */


//Request for activity daily goals
$response = $fitbit->getActivityDailyGoals();


// to get the Id's for the measurement name
$distanceMeasurementName='distance';
$activeMinutesMeasurementName='activeMinutes';
$caloriesOutMeasurementName='caloriesOut';
$stepsMeasurementName='steps';
$period = 'daily';
$periodDailyId = $db_connection->getPeriodId($period);


//access data of response
$activeMinutes = $response->goals->activeMinutes;
$caloriesOut = $response->goals->caloriesOut;
$distance = $response->goals->distance;
$steps = $response->goals->steps;


// Array for the different measurements
$measArray[0] = $distanceMeasurementName;
$measArray[1] = $activeMinutesMeasurementName;
$measArray[2] = $caloriesOutMeasurementName;
$measArray[3] = $stepsMeasurementName;

// Array for the different measurement values
$werteArray[0] = $distance;
$werteArray[1] = $activeMinutes;
$werteArray[2] = $caloriesOut;
$werteArray[3] = $steps;

// run through each value
for ($id = 0; $id < sizeof($measArray); $id++) {

    $measurementName = $measArray[$id];
    $wert = $werteArray[$id];


    $result = $db_connection->insertGoal($userId, $company, $measurementName, $wert, $periodDailyId);


    if (!$result) {

        $successfull = false;
    }

}


?>
