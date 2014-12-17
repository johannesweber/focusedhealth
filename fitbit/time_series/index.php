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

include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];
$date = $_GET["endDate"];
$limit = $_GET["limit"];
$measurement = $_GET["measurement"];

// to used in insert
require_once '../id/find_company_id.php';
require_once '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

require_once '../../id/find_id.php';

$measurementId = getMeasurementId($measurement, $db_connection);

$db_connection->selectValueFromDatabase($measurementId, $userId, $date, $limit);

$db_connection->close();

?>