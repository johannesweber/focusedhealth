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

require_once '../../db_connection.php';

require_once '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];

$company = "fitbit";
$companyId = $db_connection->getCompanyId($company);

require_once '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauthToken, $oauthTokenSecret);
$fitbit->setResponseFormat('json');

require_once '../user_info/insert/index.php';

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
require_once 'insert_activity_weekly_goals.php';
require_once 'insert_activity_daily_goals.php';
require_once 'insert_body_measurements.php';
require_once 'insert_food_goal.php';
require_once 'insert_food_plan.php';
require_once 'insert_weight_goal.php';

if (!$error) {
    echo '{"success" : "-1", "message" : "Data could not be synchronized. Please try again later!"}';
} else {
    echo '{"success" : "1", "message" : "Data successfully synchronized!"}';
}

$db_connection->close();

?>