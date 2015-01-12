<?php
/**
 *
 * This class is used to change the email with an method call.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 09.01.15
 * Time: 01:03
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$userId = $_GET["userId"];
$newEmail = $_GET["mewEmail"];

echo $result = $db_connection->insertNewEmail($userId, $newEmail);

$db_connection->close();

?>