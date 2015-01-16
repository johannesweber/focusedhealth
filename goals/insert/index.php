<?php
/**
 *
 * This class is used to insert data for goals in our database and update the value if changes occur.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 28.12.14
 * Time: 17:14
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];
$measurement = $_GET["measurement"];
$period = $_GET["period"];
$startDate = $_GET["startDate"];
$company = $_GET["company"];
$companyId = $db_connection->getCompanyId($company);
$goalValue = $_GET["goalValue"];

$db_connection->insertGoal($userId,$company,$measurement,$goalValue, $period, $startDate);

$db_connection->close();

?>