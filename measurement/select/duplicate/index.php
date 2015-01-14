<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 09.01.15
 * Time: 14:41
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

header('Content-type: application/json');

require_once '../../../db_connection.php';

$db_connection = new DatabaseConnection();

$userId = $_GET["userId"];

echo $result = $db_connection->selectDuplicateMeasurementsFromUser($userId);

$db_connection->close();

?>