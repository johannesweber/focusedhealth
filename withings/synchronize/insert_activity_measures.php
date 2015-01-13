<?php
/**
 *
 * This Class is used to retrieve and store the manufacturer's data in our database. We receive data regarding the activity measures which are stored by Withings .
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.01.15
 * Time: 21:58
 */

/* The file is written but we don't know if it's right, because we get an empty response from withings */


$response = $withings->getActivityMeasures();


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
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $distanceMeasurement, $date, $distance);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $caloriesOutMeasurement, $date, $calories);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $elevationMeasurement, $date, $elevation);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $softMeasurement, $date, $soft);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $moderateMeasurement, $date, $moderate);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $intenseMeasurement, $date, $intense);
    if (!$result) {

        $successfull = false;
    }


}



?>