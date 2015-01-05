<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 08:06
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


$error = true;

require_once 'insert_body_measurements.php';
//require_once 'insert_activity.php';


//TODO Evtl. als Methode in db_connection
/*if (!$error) {
    echo '{"success" : "-1", "message" : "Data could not be synchronized. Please try again later!"}';
} else {
    echo '{"success" : "1", "message" : "Data successfully synchronized!"}';
}*/

$db_connection->synchronizeMessage($error);
$db_connection->close();

?>