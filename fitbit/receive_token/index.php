<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 17:40
 */

require '../oauthfitbit/fitbitphp.php';

require 'db_connection.php';

$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];


//creating a new Fitbit Object to start API Calls
$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

?>