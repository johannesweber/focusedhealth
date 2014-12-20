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
$measurementName = 'bicep';
$bicepId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'calf';
$calfId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'chest';
$chestId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'forearm';
$forearmId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'hips';
$hipsId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'neck';
$neckId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'thigh';
$thighId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'waist';
$waistId = $db_connection->getMeasurementId($measurementName);


$bicep = $response->body->bicep;
//$bmi = $response->body->bmi;
$calf = $response->body->calf;
$chest = $response->body->chest;
//$fat = $response->body->fat;
$forearm = $response->body->forearm;
$hips = $response->body->hips;
$neck = $response->body->neck;
$thigh = $response->body->thigh;
$waist = $response->body->waist;
//$weight = $response->body->weight;


$measurementIdArray = array($bicepId, $calfId, $chestId, $forearmId, $hipsId, $neckId, $thighId, $waistId);

$measurementArray = array($bicep, $calf, $chest, $forearm, $hips, $neck, $thigh, $waist);


//run through each measurement
for ($x = 0; $x < sizeof($measurementIdArray); $x++) {

    $ID = $measurementIdArray[$x];
    $value = $measurementArray[$x];

//SQL Statement to check if this data set already exists for this day
    $select = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$companyId' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);

    if (!$result) {
        $error = false;
    }


    $rowCount = $result->num_rows;

//measurement was not inserted for today
    if ($rowCount == 0) {

//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('$userId', '$ID', '$companyId', '$value','$date')";

        $result = $db_connection->executeStatement($insert);

        if (!$result) {
            $error = false;
        }

//measurement was already inserted for today
    } else {

        $update = "UPDATE value SET value = '$value'
                                     WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$companyId' AND date = '$date'";

        $result = $db_connection->executeStatement($update);
        if (!$result) {
            $error = false;
        }

    }

}

?>