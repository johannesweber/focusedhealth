<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

$response = $fitbit->getProfile();

$user_id = "42";
$company_account_id = $response->user->encodedId;

//statement to find company id
include 'find_company_id.php';

//TODO send user id with iPhone
$insert_user_company_account = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, company_account_id)
VALUES ('$user_id', '$company_id', '$oauth_token', '$oauth_token_secret', '$company_account_id')";

$db_connection->executeStatement($insert_user_company_account);