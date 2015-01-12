<?php
/**
 *
 * This class is used to insert the values in our database which we get from the different Company's.
 * We check if the insert was successfully.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 04.01.15
 * Time: 17:35
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$userId = $_GET['userId'];
$company = $_GET['company'];
$measurement = $_GET['measurement'];
$value = $_GET['value'];

//converts date from string to MySQL Date
$dateString = $_GET["date"];
$timestamp = strtotime($dateString);
$date = date("Y-m-d", $timestamp);

$result = $db_connection->insertValue($userId, $company, $measurement, $date, $value);

// Verifies that was successfully inserted
if ($result) {

    echo '{"success" : "1", "message" : "Value successfully inserted"}';

} else {

    echo '{"success" : "-1", "message" : "Value was not successfully inserted"}';
}

$db_connection->close();

?>