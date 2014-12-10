<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 07.12.14
 * Time: 12:25
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();


include '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

include '../id/find_company_id.php';
include '../id/find_company_account_id.php';

include 'insert_user_info.php';
include 'select_user_info.php';

$db_connection->close();

?>
