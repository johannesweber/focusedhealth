<?php
/**
 * this class gets all important credentials from fitbit. This credentials are required to send Requests to Fitbit API
 *
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:03
 */

//TODO user id from focusedhealth required
$fetch_credentials = "SELECT * FROM user_company_account WHERE company_id='$companyId' AND user_id='$userId'";

$fetch_credentials_mysqli_result = $db_connection->executeStatement($fetch_credentials);

$fetch_credentials_result = $db_connection->getResultAsArray();

$userId = $fetch_credentials_result['user_id'];
$oauthToken = $fetch_credentials_result['oauth_token'];
$oauthTokenSecret = $fetch_credentials_result['oauth_token_secret'];
$companyAccountId = $fetch_credentials_result['company_account_id'];


?>