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

$company = 'fitbit';
$userId = $_GET["userId"];
$date = $_GET["endDate"];
$limit = $_GET["limit"];
$measurement = $_GET["measurement"];

echo $db_connection->selectValueFromDatabase($company, $measurement, $userId, $date, $limit);

$db_connection->close();

?>