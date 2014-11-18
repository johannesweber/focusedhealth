<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

require_once 'fitbitphp.php';

require_once 'db_connection.php';

$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];

//creating a new Fitbit Object to start API Calls
$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

$response = $fitbit->getProfile();

$user_id = "42";
$user_company_id = $response->user->encodedId;
$user_company_name = $response->user->fullName;

//statement to find company id
require_once 'find_company_id.php';

//TODO send user id with iPhone
$sql = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, user_company_id, user_company_name)";
$sql.= "VALUES ('$user_id', '$company_id', '$oauth_token', '$oauth_token_secret', '$user_company_id', '$user_company_name')";

require 'execute_statement.php';

?>