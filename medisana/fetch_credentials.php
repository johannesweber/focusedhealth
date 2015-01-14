<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 14.01.15
 * Time: 16:51
 *
 *
 */


$fetch_credentials = "SELECT * FROM user_company_account WHERE company_id='$companyId' AND user_id='$userId'";

$fetch_credentials_mysqli_result = $db_connection->executeStatement($fetch_credentials);

$fetch_credentials_result = $db_connection->getResultAsArray();

$userId = $fetch_credentials_result['user_id'];
 $oauth_token = $fetch_credentials_result['oauth_token'];
 $oauth_token_secret = $fetch_credentials_result['oauth_token_secret'];
  $companyAccountId = $fetch_credentials_result['company_account_id'];


?>