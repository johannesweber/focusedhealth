<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 12.01.15
 * Time: 15:56
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET['userId'];
$company = $_GET['company'];


echo $result = $db_connection->deleteCompanyFromUser($userId, $company);


$db_connection->close();

?>