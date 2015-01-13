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

echo $db_connection->selectGoalFromDatabase($company, $measurement, $userId, $period, $limit);

$db_connection->close();

?>