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

//TODO was sind activity daily goals ? bzw. was sagen sie aus? wo ist der unterschied zu den normalen goals ?
// Man erhält lt. API Explorer eine Zusammenfassung und die gleichen Sachen wie bei daily und weekly und zusätzlich wie aktiv man war
//TODO warum steht in der datenbank überall null
// Man erhält bei daily goals kein start-/enddatum und auch kein startValue lt. API Explorer
// MAn erhält bei weekly goals kein start-/enddatum und auch kein startValue lt. API Explorer
//TODO nochmal über das select statement drüber gucken

/*// goals
$db_connection->selectValueFromGoalActivity($userId, $periodDailyId); // wegen period nochmal gucken was wir hier genau übergeben müssen
$db_connection->selectValueFromGoalMeasurement($userId, $measurement, $date);
*/

$db_connection->selectGoalFromDatabase($userId, $measurement, $date);

$db_connection->close();
?>