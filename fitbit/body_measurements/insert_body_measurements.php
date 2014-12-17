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



$bicepId = getMeasurementId("bicep", $db_connection);
$calfId = getMeasurementId("calf", $db_connection);
$chestId = getMeasurementId("chest", $db_connection);
$forearmId = getMeasurementId("forearm", $db_connection);
$hipsId = getMeasurementId("hips", $db_connection);
$neckId = getMeasurementId("neck", $db_connection);
$thighId = getMeasurementId("thigh", $db_connection);
$waistId = getMeasurementId("waist", $db_connection);


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
    $select_measurement = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_measurement);
    $rowCount = $result->num_rows;

//measurement was not inserted for today
    if ($rowCount == 0) {

//SQL Statement to insert data into value table
        $insert_body = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('$userId', '$ID', '$company_id', '$value','$date')";


        $db_connection->executeStatement($insert_body);

//measurement was already inserted for today
    } else {

        $update_body = "UPDATE value SET value = '$value'
                                     WHERE user_id='$userId' AND measurement_id='$ID' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update_body);


    }
}



?>