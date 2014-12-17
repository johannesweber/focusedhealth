<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:03
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


include '../../../db_connection.php';

include '../../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];

// to used in insert
include '../../id/find_company_id.php';

// to used in select
include '../../id/find_body_fat_id.php';

include '../../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

include 'insert_fat.php';
include 'select_fat.php';

$db_connection->close();

?>