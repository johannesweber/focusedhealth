<?php
/**
 * This class gets all important credentials from Withings. This credentials are required to send Requests to Withings API.
 *
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:03
 */


$fetch_credentials = "SELECT * FROM user_company_account WHERE company_id='$companyId' AND user_id='$userId'";

$fetch_credentials_mysqli_result = $db_connection->executeStatement($fetch_credentials);

$fetch_credentials_result = $db_connection->getResultAsArray();

$user_id = $fetch_credentials_result['user_id'];
$company_id = $fetch_credentials_result['company_id'];
$oauth_token = $fetch_credentials_result['oauth_token'];
$oauth_token_secret = $fetch_credentials_result['oauth_token_secret'];
$company_account_id = $fetch_credentials_result['company_account_id'];

?>