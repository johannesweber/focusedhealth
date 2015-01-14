<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 13.01.15
 * Time: 11:51
 */

$timestamp = time();
$timestamp = date("Y-m-d", $timestamp);

if (!credentialsExists) {

//TODO send user id with iPhone
    $statement = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret,
                                                company_account_id, timestamp)
                                    VALUES ('$user_id', '$company_id', '$oauth_token', '$oauth_token_secret',
                                            '$company_account_id', '$date')";
} else {

    $statement = "UPDATE user_company_account SET oauth_token = '$oauth_token', oauth_token_secret = '$oauth_token_secret',
                            company_account_id = '$company_account_id', timestamp = '$date',
                   WHERE user_id = '$user_id'
                   AND company_id = '$company_id'";
}
$result = $db_connection->executeStatement($statement);

$db_connection->showAuthorizeMessage($company, $result);

?>