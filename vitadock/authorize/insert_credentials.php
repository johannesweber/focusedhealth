<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 13.01.15
 * Time: 11:51
 */


$statement = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, company_account_id, timestamp)
                VALUES ('$userId', '$companyId', '$oauthToken', '$oauthTokenSecret', '$companyAccountId','$timestamp')";

$db_connection->executeStatement($statement);

?>