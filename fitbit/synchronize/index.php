<?php
/**
 * this call is called when the user want to synchronize its data.
 * in this class we fetch the users credentials from our database and request the user info from fitbit.
 * then we store the user info in our own database. after storing the user info we fetch user info from our
 * database and create a json object for preparing the file to get fetched by the users iPhone.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 25.11.14
 * Time: 07:34
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];


// to used in insert
include '../id/find_company_id.php';

// for using to get the id
include '../../id/find_id.php';

include '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

require_once '../id/find_member_since.php';
include 'insert_steps.php';

$db_connection->close();


?>