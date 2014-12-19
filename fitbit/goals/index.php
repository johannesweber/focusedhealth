<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 19.12.14
 * Time: 20:35
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';
include '../fitbitphp.php';

$userId = $_GET["userId"];
$date = $_GET["endDate"];
$measurement = $_GET["measurement"];

/*// goals
$db_connection->selectValueFromGoalActivity($userId, $periodDailyId); // wegen period nochmal gucken was wir hier genau übergeben müssen
$db_connection->selectValueFromGoalMeasurement($userId, $measurement, $date);
*/

$db_connection->selectValueFromGoal($userId, $measurement, $date, $periodDailyId);

$db_connection->close();
?>