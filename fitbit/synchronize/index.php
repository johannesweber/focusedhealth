<?php
/**
 * this call is called when the user want to synchronize its data.
 * in this class we fetch the users credentials from our database and request the user info from fitbit.
 * then we store the user info in our own database. after storing the user info we fetch user info from our
 * database and create a json object for preparing the file to get fetched by the users iPhone.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 25.11.14
 * Time: 07:34
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];


// to used in insert
include '../id/find_company_id.php';

include '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

require_once '../id/find_member_since.php';

$error = true;

require_once 'insert_steps.php';
require_once 'insert_distance.php';
require_once 'insert_calories_out.php';
require_once 'insert_calories_in.php';
require_once 'insert_elevation.php';
require_once 'insert_fat.php';
require_once 'insert_floors.php';
require_once 'insert_minutesAsleep.php';
require_once 'insert_minutesAwake.php';
require_once 'insert_minutesToFallAsleep.php';
require_once 'insert_sleep_start_time.php';
require_once 'insert_time_in_bed.php';
require_once 'insert_water.php';
require_once 'insert_weight.php';
require_once 'insert_awakeningsCount.php';
require_once 'insert_bmi.php';
//require_once 'insert_activity_weekly_goals';
//require_once 'insert_activity_daily_goals';
//require_once 'insert_body_measurements';
//require_once 'insert_food_goal';
//require_once 'insert_food_plan.php';
//require_once 'insert_weight_goal.php';


if (!$error) {
    echo '{"success" : "-1", "message" : "insert statements were not successfull"}';
} else {
    echo '{"success" : "1", "message" : "steps statements were successfull"}';
}

$db_connection->close();

?>