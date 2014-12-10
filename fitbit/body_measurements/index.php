<?php
/**
 * this call is called when the user want to synchronize its data.
 * in this class we fetch the users credentials from our database and request the user info from fitbit.
 * then we store the user info in our own database. after storing the user info we fetch user info from our
 * database and create a json object for preparing the file to get fetched by the users iPhone.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */


header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];

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

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

include 'insert_body_measurements.php';
include 'select_body_measurements.php';

$db_connection->close();

?>