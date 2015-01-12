<?php
/**
 *
 * This class is used to select the value of food from our database and provide it to our Mobile App.
 *
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 11:56
 */


header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$company = $_GET["company"];
$userId = $_GET["userId"];
$date = $_GET["endDate"];
$limit = $_GET["limit"];



echo $db_connection->selectFoodFromDatabase($company, $userId, $date, $limit);

$db_connection->close();

?>