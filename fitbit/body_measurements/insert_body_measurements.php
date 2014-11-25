<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */

$timestamp=time();
$date=date("Y-m-d", $timestamp);

echo $date;

$response = $fitbit->getBody($date);

print_r($response);

$bicep = $response->body->bicep;
echo $bicep;
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

include 'fetch_body_measurements.php';

//SQL Statement to insert data into value table
$insert_body = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('42', '$bicepId', '$company_id', '$bicep',NULL),
                ('42', '$bmiId', '$company_id', '$bmi',NULL),
                ('42', '$calfId', '$company_id', '$calf',NULL),
                ('42', '$chestId', '$company_id', '$chest',NULL),
                ('42', '$fatId', '$company_id', '$fat',NULL),
                ('42', '$forearmId', '$company_id', '$forearm',NULL),
                ('42', '$hipsId', '$company_id', '$hips',NULL),
                ('42', '$neckId', '$company_id', '$neck',NULL),
                ('42', '$thighId', '$company_id', '$thigh',NULL),
                ('42', '$waistId', '$company_id', '$waist',NULL),
                ('42', '$weightId', '$company_id', '$weight',NULL)";

$db_connection->executeStatement($insert_body);

?>