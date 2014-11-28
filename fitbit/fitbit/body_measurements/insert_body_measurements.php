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