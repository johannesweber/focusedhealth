<?php
/**
 * this class gets all important credentials from fitbit. This credentials are required to send API Requests to Fitbit
 *
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 22:03
 */

include_once 'db_connection.php';

include_once 'find_company_id.php';

//TODO user id required
$fetch_credentials = "SELECT * FROM user_company_account WHERE company_id='$company_id' AND user_id='42'";

$sql_result = mysqli_query($db_connection,$fetch_credentials);

$result = mysqli_fetch_array($sql_result, MYSQL_ASSOC);

$user_id = $result['user_id'];
$company_id = $result['company_id'];
$user_company_mail = $result['user_company_mail'];
$oauth_token = $result['oauth_token'];
$oauth_token_secret = $result['oauth_token_secret'];
$user_company_id = $result['user_company_id'];
$user_company_name = $result['user_company_name'];

?>