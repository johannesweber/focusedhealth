<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */

/*$timestamp = time();
$date = date("Y-m-d", $timestamp);
*/
$startdate = "1417392000"; //1 dez.
$enddate = "1417737600";
$response = $withings->getBodyMeasures();
print_r($response);

$int = 1780;
$double = number_format(($int / 1000), 3);

/*
$today = time();
$startdate = "1417392000"; //1 dez.
$enddate = "1417737600"; //5 dez.
$response2 = $withings->getBodyMeasuresTimeRange($startdate, $enddate);
*/

// get all id's wich are neccessary
$measurementName = 'weight';
$weightId = $db_connection->getMeasurementId($measurementName);
//$weightId = getMeasurementId("weight", $db_connection);
$measurementName = 'height';
$heightId = $db_connection->getMeasurementId($measurementName);
//$heightId = getMeasurementId("height", $db_connection);
$measurementName = 'fatFreeMass';
$fatFreeMassId = $db_connection->getMeasurementId($measurementName);
//$fatFreeMassId = getMeasurementId("fatFreeMass", $db_connection);
$measurementName = 'fat';
$fatId = $db_connection->getMeasurementId($measurementName);
//$fatId = getMeasurementId("fat", $db_connection);
$measurementName = 'fatMass';
$fatMassId = $db_connection->getMeasurementId($measurementName);
//$fatMassId = getMeasurementId("fatMass", $db_connection);
$measurementName = 'diastolic';
$diastolicId = $db_connection->getMeasurementId($measurementName);
//$diastolicId = getMeasurementId("diastolic", $db_connection);
$measurementName = 'systolic';
$systolicId = $db_connection->getMeasurementId($measurementName);
//$systolicId = getMeasurementId("systolic", $db_connection);
$measurementName = 'heartRate';
$heartRateId = $db_connection->getMeasurementId($measurementName);
//$heartRateId = getMeasurementId("heartRate", $db_connection);
$measurementName = 'spO2';
$spO2Id = $db_connection->getMeasurementId($measurementName);
//$spO2Id = getMeasurementId("spO2", $db_connection);
/*echo "weight: " . $weightId . "\nheight: " . $heightId . "\nfatFreeMass: " . $fatFreeMassId . "\nfat: " . $fatId
    . "\nfatMass: " . $fatMassId
    . "\ndiastolic: " . $diastolicId
    . "\nsystolic: " . $systolicId
    . "\nheartRate: " . $heartRateId
    . "\nspo02: " . $spO2Id;
*/

// connecting meastype from withings with measure id's from focused health
$meastypeWithings = array(1 => $weightId, 4 => $heightId, 5 => $fatFreeMassId, 6 => $fatId, 8 => $fatMassId, 9 => $diastolicId, 10 => $systolicId, 11 => $heartRateId, 54 => $spO2Id);

$measuregrpsArray = $response->body->measuregrps;

//run through each date
for ($x = 0; $x < sizeof($measuregrpsArray); $x++) {

    //need to know if value is a real measurement or a goal !
    $category = $measuregrpsArray[$x]->category;
    $timestamp = $measuregrpsArray[$x]->date;
    $date = date("Y-m-d", $timestamp);

    // values of the day
    $valueArray = $measuregrpsArray[$x]->measures;

// run through each value of the date
    for ($i = 0; $i < sizeof($valueArray); $i++) {
        //print_r($valueArray[$i]);

        echo $value = $valueArray[$i]->value;
        echo "//";
        echo $type = $valueArray[$i]->type;

        // get the measurement id from focused health
        echo "measureID:" . $measurementId = $meastypeWithings[$type];

        //$rowCount = $db_connection->checkIfvalueExists($user_id, $measurementId, $company_id, $date);

        //if category is a real measurement
        if ($category == 1) {


            //measurement was not inserted for today
            if ($rowCount == 0) {


                //SQL Statement to insert data into value table


                $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('$user_id', '$measurementId', '$company_id', '$value','$date')";


                $db_connection->executeStatement($insert);


            } else {
                //update
            }

            // if category is a goal
        } else if ($category == 2) {

        } else {

        }
    }

}





/*
$bicep = $response->body->bicep;

$calf = $response->body->calf;
$chest = $response->body->chest;

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

*/

?>