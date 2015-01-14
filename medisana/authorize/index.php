<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 13.01.15
 * Time: 11:51
 */

error_reporting(E_ALL);
ini_set('display errors', 'On');


//include File
require_once '../medisanaphp.php';
require_once '../../db_connection.php';



$db_connection = new DatabaseConnection();
$db_connection->connect();



$userId = $_POST['userId'];
$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];

//for testing
//$oauth_token = "Y8yKakRtjVx3LACnPXeCAchW9YC0NArWjVLroYMFRZZas3FDiBLsd4Vf3W1mtSvW";
//$oauth_token_secret = "EBrpwLT9N20hM7nmKWeZrspvym5bmPRPlh0pw9Lawkajw96jeiE3a4y3q0bzGqvD";



//create new medisana php object with consumer key and consumer secret
$vitadock = new medisanaPHP();
//set the access token and secret for this request
$vitadock->setOAuthDetails($oauth_token, $oauth_token_secret);


$company = "medisana";
$companyId = $db_connection->getCompanyId($company);

require_once 'insert_credentials.php';

$db_connection->close();

?>