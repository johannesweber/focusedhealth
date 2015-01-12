<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 13:06
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

//$result = $db_connection->;

if ($result) {

    echo '{"success" : "1", "message" : "Value successfully inserted"}';

} else {

    echo '{"success" : "-1", "message" : "Value was not successfully inserted"}';
}

$db_connection->close();

?>