<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */



//$company_account_id = $response->user->encodedId;
$timestamp = time();
$date = date("Y-m-d", $timestamp);


//TODO send user id with iPhone
$insert_user_company_account = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, company_account_id, timestamp)
VALUES ('$userid', '$company_id', '$oauth_token', '$oauth_token_secret', '$company_account_id', '$date')";

$db_connection->executeStatement($insert_user_company_account);