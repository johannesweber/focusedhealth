<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 09.01.15
 * Time: 14:41
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../../db_connection.php';

$db_connection = new DatabaseConnection();

$userId = $_GET["userId"];

echo $db_connection->selectAllMeasurementsFromUser($userId);

$db_connection->close();

?>