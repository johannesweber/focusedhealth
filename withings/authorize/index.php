<?php
/**
 * this class is executed when the user presses the add device button.
 * in this class we are getting the aouth token and token secret from our iPhone and store them for
 * further requests in our database.
 * afterwards we fetch all the data from the withings device.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 18:23
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';
include '../withingsphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

/*echo $comanyAccountId = $_GET['userid'];
echo $oauth_token = $_GET['oauth_token'];
echo $oauth_token_secret = $_GET['oauth_token_secret'];
*/

$company_account_id = '5064852';
$oauth_token = '7c144c3075d37c657e7f4079cf6e508517d7626c2e6c8e384065429';
$oauth_token_secret = '779e3cbfb2d220e4fd236fcbb75269f28394fcfc3617f66e5f5bcf27e7e';



$withings = new WithingsPHP();
$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $userid);

include '../id/find_company_id.php';
include '../id/find_company_account_id.php';

include 'insert_credentials.php';

include '../fetch_credentials.php';

//start to insert

include '../user_info/insert_user_info.php';

$db_connection->close();

?>