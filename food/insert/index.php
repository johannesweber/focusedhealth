<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 14:56
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$userId = $_GET['userId'];
$company = $_GET['company'];
$amount = $_GET['amount'];
$brand = $_GET['brand'];
$unit = $_GET['unit'];
$calories = $_GET['calories'];
$carbs = $_GET['carbs'];
$fat = $_GET['fat'];
$fiber = $_GET['fiber'];
$protein = $_GET['protein'];
$sodium = $_GET['sodium'];
$name = $_GET['name'];

//converts date from string to MySQL Date
$dateString = $_GET["date"];
$timestamp = strtotime($dateString);
$date = date("Y-m-d", $timestamp);

$result = $db_connection->insertFood($userId, $company, $date, $amount, $brand, $name, $unit, $calories, $carbs, $fat, $fiber, $protein, $sodium);

if ($result) {

    echo '{"success" : "1", "message" : "Value successfully inserted"}';

} else {

    echo '{"success" : "-1", "message" : "Value was not successfully inserted"}';
}

$db_connection->close();

?>