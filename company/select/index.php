<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 12.01.15
 * Time: 22:46
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

if ($_GET) {

    $userId = $_GET["userId"];
    echo $result = $db_connection->selectCompaniesFromUser($userId);

} else {

    echo $result = $db_connection->selectAllCompanies();
}

$db_connection->close();

?>