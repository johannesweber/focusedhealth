<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 15:56
 */

header('Content-type: application/json; charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

echo $result = $db_connection->selectCategoryFromDatabase();

$db_connection->close();

?>