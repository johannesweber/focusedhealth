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

include 'find_company_id.php';

//TODO user id from focusedhealth required
$fetch_credentials = "SELECT * FROM user_company_account WHERE company_id='$company_id' AND user_id='42'";

$fetch_credentials_mysqli_result = $db_connection->executeStatement($fetch_credentials);

$fetch_credentials_result = mysqli_fetch_array( $fetch_credentials_mysqli_result, MYSQL_ASSOC);

$user_id = $fetch_credentials_result['user_id'];
$company_id = $fetch_credentials_result['company_id'];
$oauth_token = $fetch_credentials_result['oauth_token'];
$oauth_token_secret = $fetch_credentials_result['oauth_token_secret'];
$company_account_id = $fetch_credentials_result['company_account_id'];

?>