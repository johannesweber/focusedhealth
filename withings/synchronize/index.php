<?php
/**
 *
 * This class is needed to execute all statements to save Withings data in our database. This class includes the other php files and perform different method calls.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 08:06
 */

header('Content-type: application/json');

//For Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$successfull = true;

//include files
require_once '../../db_connection.php';
require_once '../withingsphp.php';

$db_connection = new DatabaseConnection();
$db_connection->connect();

$userId = $_GET['userId'];


// used in insert
$company = "withings";
$companyId = $db_connection->getCompanyId($company);

require_once '../fetch_credentials.php';

$withings = new WithingsPHP();
$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $company_account_id);

require_once 'insert_body_measures.php';
require_once 'insert_sleep_summary.php';

// method call to get a message if synchronize was successfull
$withings->showSynchronizeMessage($company,$successfull);

$db_connection->close();

?>