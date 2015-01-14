<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 13.01.15
 * Time: 11:51
 */

$timestamp = time();
$timestamp = date("Y-m-d", $timestamp);

$credentialsExists = $db_connection->checkIfCredentialsExists($company, $userId);


if (!$credentialsExists) {

//TODO send user id with iPhone
    $statement = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret,
                                                company_account_id, timestamp)
                                    VALUES ('$userId', '$companyId', '$oauth_token', '$oauth_token_secret',
                                            '$company_account_id', '$date')";
} else {

    $statement = "UPDATE user_company_account SET oauth_token = '$oauth_token', oauth_token_secret = '$oauth_token_secret',
                            company_account_id = '$company_account_id', timestamp = '$date',
                   WHERE user_id = '$userId'
                   AND company_id = '$companyId'";
}
$result = $db_connection->executeStatement($statement);

$db_connection->showAuthorizeMessage($company, $result);

?>