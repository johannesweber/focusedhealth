<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 14.01.15
 * Time: 12:50
 */



echo '{"success" : "-1", "message" : "Vitadock could not be synchronized."}';


error_reporting(E_ALL);
ini_set('display errors', 'On');


//include File
require_once '../medisanaphp.php';
require_once '../../db_connection.php';




$db_connection = new DatabaseConnection();
$db_connection->connect();



$userId = $_POST['userId'];

$company = "medisana";
$companyId = $db_connection->getCompanyId($company);

require_once '../fetch_credentials.php';



//create new medisana php object with consumer key and consumer secret
$vitadock = new medisanaPHP();
//set the access token and secret for this request
$vitadock->setOAuthDetails($oauth_token, $oauth_token_secret);


require_once 'insert_data.php';


?>