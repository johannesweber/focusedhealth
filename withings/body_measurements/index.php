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


require_once '../../db_connection.php';

require_once '../withingsphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

//$user_id = $_POST['user_id'];
$user_id = '52';

// is used in insert
require_once '../id/find_body_fat_id.php';
require_once '../id/find_weight_id.php';

require_once '../id/find_height_id.php';
require_once '../id/find_pulse_id.php';
require_once '../id/find_fat_free_mass_id.php';
require_once '../id/find_fat_mass_id.php';
require_once '../id/find_systolic_id.php';
require_once '../id/find_diastolic_id.php';
require_once '../id/find_spo2_id.php';

require_once '../id/find_company_id.php';
require_once '../fetch_credentials.php';

$withings = new WithingsPHP();
$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $company_account_id);


require_once 'insert_body_measurements.php';

$db_connection->close();