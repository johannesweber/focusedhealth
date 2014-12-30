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

require_once '../../db_connection.php';
require_once '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_POST['userId'];
$oauthToken = $_POST['oauth_token'];
$oauthTokenSecret = $_POST['oauth_token_secret'];

/*
 * params:  Consumer Key = 7c39abf127964bc984aba4020845ff11
 * and Cumsumer Secret = 18c4a92f21f1458e8ac9798567d3d38c from Fitbit
 */
$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauthToken, $oauthTokenSecret);
$fitbit->setResponseFormat('json');

$response = $fitbit->getProfile();

$companyAccountId = $response->user->encodedId;

$timestamp = date("Y-m-d", time());
$company = "fitbit";
$companyId = $db_connection->getCompanyId($company);

/*
 * credentials are userId, companyId, userCompanyMail if exists, oauthToken
 * oauthTokenSecret, companyAccountId and a Timestamp
 */
require_once 'insert_credentials.php';

$db_connection->close();

?>