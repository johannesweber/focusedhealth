<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 27.11.14
 * Time: 11:30
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../../db_connection.php';

include '../../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];
$selectDate = $_GET["endDate"];
$selectLimit = $_GET["limit"];


// to used in insert
include '../../id/find_company_id.php';
//include '../../id/find_steps_id.php';

include '../../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

require_once '../../id/find_member_since.php';
//include 'insert_steps.php';



include_once 'select_steps.php';

$db_connection->close();

?>