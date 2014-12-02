<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */

$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getBody($date);
print_r($response);

$bicep = $response->body->bicep;
$bmi = $response->body->bmi;
$calf = $response->body->calf;
$chest = $response->body->chest;
$fat = $response->body->fat;
$forearm = $response->body->forearm;
$hips = $response->body->hips;
$neck = $response->body->neck;
$thigh = $response->body->thigh;
$waist = $response->body->waist;
$weight = $response->body->weight;

include 'find_bicep_id.php';
include 'find_bmi_id.php';
include 'find_calf_id.php';
include 'find_chest_id.php';
include 'find_body_fat_id.php';
include 'find_forearm_id.php';
include 'find_hips_id.php';
include 'find_neck_id.php';
include 'find_thigh_id.php';
include 'find_waist_id.php';
include 'find_weight_id.php';



$measurementIdArray = array($bicepId, $bmiId, $calfId, $chestId, $fatId, $forearmId, $hipsId, $neckId, $thighId, $waistId, $weightId);

$measurementArray = array($bicep, $bmi, $calf, $chest, $fat, $forearm, $hips, $neck, $thigh, $waist, $weight);



for ($x = 0; $x < sizeof($measurementIdArray); $x++) {

    $ID = $measurementIdArray[$x];
    $value = $measurementArray[$x];

//SQL Statement to
$select_measurement = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$ID' AND company_id='$company_id' AND date= '$date' ";
$result = $db_connection->executeStatement($select_measurement);
$rowCount = $result->num_rows;

//weight was not inserted today
if ($rowCount == 0) {


//SQL Statement to insert data into value table
    $insert_body = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('42', '$ID', '$company_id', '$value','$date')";

            /*
                ('42', '$bmiId', '$company_id', '$bmi','$date'),
                ('42', '$calfId', '$company_id', '$calf','$date'),
                ('42', '$chestId', '$company_id', '$chest','$date'),
                ('42', '$fatId', '$company_id', '$fat','$date'),
                ('42', '$forearmId', '$company_id', '$forearm','$date'),
                ('42', '$hipsId', '$company_id', '$hips','$date'),
                ('42', '$neckId', '$company_id', '$neck','$date'),
                ('42', '$thighId', '$company_id', '$thigh','$date'),
                ('42', '$waistId', '$company_id', '$waist','$date'),
                ('42', '$weightId', '$company_id', '$weight','$date')";
*/
    $db_connection->executeStatement($insert_body);


} else {

    $update_body = "UPDATE value SET value = '$value'
                                     WHERE user_id='42' AND measurement_id='$ID' AND company_id='$company_id' AND date = '$date'";

    $db_connection->executeStatement($update_body);

}
}



?>