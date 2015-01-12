<?php
/**
 *
 * This class is used to get the data of activities from Withings. This data will be stored in our database.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 11.12.14
 * Time: 11:51
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once '../../db_connection.php';

require_once '../withingsphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

//$user_id = $_POST['user_id'];
$userId = '52';


// to used in insert
$company = "withings";
$companyId = $db_connection->getCompanyId($company);

require_once '../fetch_credentials.php';

$withings = new WithingsPHP();
$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $company_account_id);

require_once 'insert_activity_measures.php';

$db_connection->close();

?>