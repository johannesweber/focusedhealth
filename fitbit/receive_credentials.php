<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

include_once 'fitbitphp.php';

include_once 'db_connection.php';

$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];

//creating a new Fitbit Object to start API Calls
$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

$response = $fitbit->getProfile();

$user_id = "42";
$user_company_id = $response->user->encodedId;
$user_company_name = $response->user->fullName;

//statement to find company id
require 'find_company_id.php';

//TODO send user id with iPhone
$insert_user_company_account = "INSERT INTO user_company_account (user_id, company_id, oauth_token, oauth_token_secret, user_company_id, user_company_name)";
$insert_user_company_account.= "VALUES ('$user_id', '$company_id', '$oauth_token', '$oauth_token_secret', '$user_company_id', '$user_company_name')";

$result_user_company_account = mysqli_query( $db_connection, $insert_user_company_account );

if ( ! $result_user_company_account )
{
    die('Ungültige Abfrage: '. mysqli_error($db_connection));
} else {
    echo "hat funktioniert";
}

mysqli_free_result($result_user_company_account);

?>