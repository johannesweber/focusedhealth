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

$company = 'withings';

// get all id's wich are neccessary
$measurement = 'weight';
$weightId = $db_connection->getMeasurementId($measurement);
$measurement = 'height';
$heightId = $db_connection->getMeasurementId($measurement);
$measurement = 'fatFreeMass';
$fatFreeMassId = $db_connection->getMeasurementId($measurement);
$measurement = 'fat';
$fatId = $db_connection->getMeasurementId($measurement);
$measurement = 'fatMass';
$fatMassId = $db_connection->getMeasurementId($measurement);
$measurement = 'diastolic';
$diastolicId = $db_connection->getMeasurementId($measurement);
$measurement = 'systolic';
$systolicId = $db_connection->getMeasurementId($measurement);
$measurement = 'heartRate';
$heartRateId = $db_connection->getMeasurementId($measurement);
$measurement = 'spO2';
$spO2Id = $db_connection->getMeasurementId($measurement);
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
        echo "measureID: " . $measurementId = $meastypeWithings[$type];

        //$rowCount = $db_connection->checkIfValueExists($user_id, $measurementId, $company_id, $date);
        $rowCount = $db_connection->checkIfValueExists($user_id, $company, $measurement, $date, $value);

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
?>