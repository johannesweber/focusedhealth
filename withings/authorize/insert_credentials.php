<?php
/**
 * This class is used to check if credentials exists and insert or update credentials like userId, oauthToken etv. in our database.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

$timestamp = time();
$date = date("Y-m-d", $timestamp);

$credentialExists = $db_connection->checkIfCredentialsExists($company, $userId);

if (!$credentialExists) {

//TODO send user id with iPhone
    $statement = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret,
                                                company_account_id, timestamp)
                                    VALUES ('$userId', '$companyId', '$oauth_token', '$oauth_token_secret',
                                            '$company_account_id', '$date')";
} else {

    $statement = "UPDATE user_company_account SET oauth_token = '$oauth_token', oauth_token_secret = '$oauth_token_secret',
                            company_account_id = '$company_account_id', timestamp = '$date'
                   WHERE user_id = $userId
                   AND company_id = $companyId
                   ";
}
$result = $db_connection->executeStatement($statement);

// method call to give out a message
$db_connection->showAuthorizeMessage($company, $result);

?>