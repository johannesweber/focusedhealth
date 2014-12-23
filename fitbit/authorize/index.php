<?php
/**
 * this class is executed when the user presses the add device button.
 * in this class we are getting the aouth token and token secret from our iPhone and store them for
 * further requests in our database.
 * afterwards we fetch all the data from the fitbit device.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 18:23
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';
include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_POST['userId'];
$oauthToken = $_POST['oauth_token'];
$oauthTokenSecret = $_POST['oauth_token_secret'];

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauthToken, $oauthTokenSecret);
$fitbit->setResponseFormat('json');

include '../id/find_company_id.php';
include '../id/find_company_account_id.php';

include 'insert_credentials.php';

include '../fetch_credentials.php';

//start to insert

include '../user_info/insert_user_info.php';

$result = $db_connection->getResult();

$db_connection->close();

?>