<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 *
 * to insert credentials (tokens , company user id)
 */

$credentialsExists = $db_connection->checkIfCredentialsExists($company, $userId);

if (!$credentialsExists) {

    $statement = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, company_account_id, timestamp)
                  VALUES ('$userId', '$companyId', '$oauthToken', '$oauthTokenSecret', '$companyAccountId', '$timestamp')";

} else {

    $statement = "UPDATE user_company_account SET oauth_token = '$oauthToken', oauth_token_secret = '$oauthTokenSecret',
                  company_account_id = '$companyAccountId', timestamp = '$timestamp'
                  WHERE user_id = '$userId'
                  AND company_id = '$companyId'";
}

$result = $db_connection->executeStatement($statement);

$db_connection->showAuthorizeMessage($company, $result);

?>