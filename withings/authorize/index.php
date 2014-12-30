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

require_once '../../db_connection.php';
require_once '../withingsphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$user_id = $_POST['user_id'];
$company_account_id = $_POST['company_account_id'];
$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];


$withings = new WithingsPHP();
$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $company_account_id);

require_once '../id/find_company_id.php';

require_once 'insert_credentials.php';

$db_connection->close();

?>