<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */


$timestamp = time();
$date = date("Y-m-d", $timestamp);

$response = $fitbit->getBody($date);

// to get the Id's for the measurement name
$bicepMeasurementName = 'bicep';
$calfMeasurementName = 'calf';
$chestMeasurementName = 'chest';
$forearmMeasurementName = 'forearm';
$hipsMeasurementName = 'hips';
$neckMeasurementName = 'neck';
$thighMeasurementName = 'thigh';
$waistMeasurementName = 'waist';


$bicep = $response->body->bicep;
$calf = $response->body->calf;
$chest = $response->body->chest;
$forearm = $response->body->forearm;
$hips = $response->body->hips;
$neck = $response->body->neck;
$thigh = $response->body->thigh;
$waist = $response->body->waist;


$valueArray = array($bicep, $calf, $chest, $forearm, $hips, $neck, $thigh, $waist);

$measurementArray = array($bicepMeasurementName, $calfMeasurementName, $chestMeasurementName, $forearmMeasurementName,
                            $hipsMeasurementName, $neckMeasurementName, $thighMeasurementName, $waistMeasurementName);


//run through each measurement
for ($x = 0; $x < sizeof($measurementArray); $x++) {

    $measurementName = $measurementArray[$x];
    $value = $valueArray[$x];

    $result = $db_connection->insertValue($userId, $company, $measurementName, $date, $value);


    if (!$result) {

        $successfull = false;
    }

}


?>