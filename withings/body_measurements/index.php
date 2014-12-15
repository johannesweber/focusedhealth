<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 11.12.14
 * Time: 11:51
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


include '../../db_connection.php';

include '../withingsphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userid = '5064852';

// is used in insert
include '../id/find_bicep_id.php';
//include '../id/find_bmi_id.php';
include '../id/find_calf_id.php';
include '../id/find_chest_id.php';
//include '../id/find_body_fat_id.php';
include '../id/find_forearm_id.php';
include '../id/find_hips_id.php';
include '../id/find_neck_id.php';
include '../id/find_thigh_id.php';
include '../id/find_waist_id.php';
//include '../id/find_weight_id.php';


include '../fetch_credentials.php';

$withings = new WithingsPHP();
$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $userid);
$withings->setResponseFormat('json');

include 'insert_body_measurements.php';
//include 'select_body_measurements.php';

$db_connection->close();