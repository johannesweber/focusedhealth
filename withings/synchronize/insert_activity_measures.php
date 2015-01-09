<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.01.15
 * Time: 21:58
 */



$response = $withings->getActivityMeasures();
print_r($response);

$successfull = true;

$activityArray = $response->body->activities;

// get all id's wich are neccessary
$stepsMeasurement = 'steps';
$stepsId = $db_connection->getMeasurementId($stepsMeasurement);
$distanceMeasurement = 'distance';
$distanceId = $db_connection->getMeasurementId($distanceMeasurement);
$caloriesOutMeasurement = 'caloriesOut';
$caloriesOutId = $db_connection->getMeasurementId($caloriesOutMeasurement);
$elevationMeasurement = 'elevation';
$elevationId = $db_connection->getMeasurementId($elevationMeasurement);
$softMeasurement = 'soft';
$softId = $db_connection->getMeasurementId($softMeasurement);
$moderateMeasurement = 'moderate';
$moderateId = $db_connection->getMeasurementId($moderateMeasurement);
$intenseMeasurement = 'intense';
$intenseId = $db_connection->getMeasurementId($intenseMeasurement);


//run through each date
for($x = 0; $x <sizeof($activityArray); $x++ ){

    $date = $activityArray[$x]->date;
    $steps = $activityArray[$x]->steps;
    $distance = $activityArray[$x]->distance;
    $calories = $activityArray[$x]->calories;
    $elevation = $activityArray[$x]->elevation;
    $soft = $activityArray[$x]->soft;
    $moderate = $activityArray[$x]->moderate;
    $intense = $activityArray[$x]->intense;


    $result = $db_connection->insertValue($userId, $company, $stepsMeasurement, $date, $steps);
    $result = $db_connection->insertValue($userId, $company, $distanceMeasurement, $date, $distance);
    $result = $db_connection->insertValue($userId, $company, $caloriesOutMeasurement, $date, $calories);
    $result = $db_connection->insertValue($userId, $company, $elevationMeasurement, $date, $elevation);
    $result = $db_connection->insertValue($userId, $company, $softMeasurement, $date, $soft);
    $result = $db_connection->insertValue($userId, $company, $moderateMeasurement, $date, $moderate);
    $result = $db_connection->insertValue($userId, $company, $intenseMeasurement, $date, $intense);


}

$withings->showSynchronizeMessage($successfull);

?>