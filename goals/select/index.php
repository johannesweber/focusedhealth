<?php
/**
 *
 * This class is used to make an method call that we select goals from our database and provide it to our Mobile App.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 19.12.14
 * Time: 20:35
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$userId = $_GET["userId"];
$measurement = $_GET["measurement"];
$period = $_GET["period"];
$company = $_GET["company"];
$limit = $_GET["limit"];

//TODO was sind activity daily goals ? bzw. was sagen sie aus? wo ist der unterschied zu den normalen goals ?
// Man erhält lt. API Explorer eine Zusammenfassung und die gleichen Sachen wie bei daily und weekly und zusätzlich wie aktiv man war
//TODO warum steht in der datenbank überall null
// Man erhält bei daily goals kein start-/enddatum und auch kein startValue lt. API Explorer
// MAn erhält bei weekly goals kein start-/enddatum und auch kein startValue lt. API Explorer
//TODO nochmal über das select statement drüber gucken

echo $db_connection->selectGoalFromDatabase($measurement, $userId, $period, $limit);

$db_connection->close();

?>