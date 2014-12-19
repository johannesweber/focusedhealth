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

$measurementId = $db_connection->getMeasurementId($measurement);

$db_connection->selectValueFromDatabase($measurementId, $userId, $date, $limit);

$db_connection->close();

?>