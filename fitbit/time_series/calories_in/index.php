<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 */


header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../../db_connection.php';

include '../../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];

include '../../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

include 'insert_calories_in.php';
include 'select_calories_in.php';

$db_connection->close();

?>