<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

include 'fitbitphp.php';

$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];

//creating a new Fitbit Object to start API Calls
$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

$response = $fitbit->getProfile();

$user_id = "42";
$company_account_id = $response->user->encodedId;
$company_account_name = $response->user->fullName;

//statement to find company id
include 'find_company_id.php';

//TODO send user id with iPhone
$insert_user_company_account = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, company_account_id, company_account_name)
VALUES ('$user_id', '$company_id', '$oauth_token', '$oauth_token_secret', '$company_account_id', '$company_account_name')";

$db_connection->executeStatement($insert_user_company_account);