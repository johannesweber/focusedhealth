<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 13:06
 *
 * to insert activity which is insert by the user manually
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

// data send by phone
$userId = $_GET['userId'];
$company = $_GET['company'];
$calories = $_GET['calories'];
$distance = $_GET['distance'];
$descreption = $_GET['descreption'];
$duration = $_GET['duration'];
$lastModified = $_GET['lastModified'];
$name = $_GET['name'];

$startTime = $_GET['startTime'];

//converts date from string to MySQL Date
$dateString = $_GET["date"];
$timestamp = strtotime($dateString);
$startDate = date("Y-m-d", $timestamp);

$result = $db_connection->insertActivity($userId, $company, $calories, $distance, $descreption, $duration, $lastModified, $name, $startDate, $startTime);

if ($result) {

    echo '{"success" : "1", "message" : "Value successfully inserted"}';

} else {

    echo '{"success" : "-1", "message" : "Value was not successfully inserted"}';
}

$db_connection->close();

?>