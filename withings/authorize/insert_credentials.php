<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

$timestamp = time();
$date = date("Y-m-d", $timestamp);

if (!credentialsExists) {

//TODO send user id with iPhone
    $insert_user_company_account = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret,
                                                company_account_id, timestamp)
                                    VALUES ('$user_id', '$company_id', '$oauth_token', '$oauth_token_secret',
                                            '$company_account_id', '$date')";
} else {

    $statement = "UPDATE user_company_account SET oauth_token = '$oauth_token', oauth_token_secret = '$oauth_token_secret',
                            company_account_id = '$company_account_id', timestamp = '$date',
                   WHERE user_id = '$user_id'
                   AND company_id = '$company_id'";
}
$result = $db_connection->executeStatement($insert_user_company_account);

$db_connection->showAuthorizeMessage($company, $result);

?>