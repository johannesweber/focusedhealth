<?php
/**
 *
 * This class is used to make an method call that we select activitites from our database and provide it to our Mobile App.
 *
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 11:17
 *
 * get activity
 */


header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

// data send by phone
$company = $_GET["company"];
$userId = $_GET["userId"];
$date = $_GET["endDate"];
$limit = $_GET["limit"];


echo $db_connection->selectActivityFromDatabase($company, $userId, $date, $limit);

$db_connection->close();

?>