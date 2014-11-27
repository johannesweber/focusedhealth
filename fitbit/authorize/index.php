<?php
/**
 * this class is executed when the user presses the add device button.
 * in this class we are getting the aouth token and token secret from our iPhone and store them for
 * further requests in our database.
 * afterwards we fetch all the data from the fitbit device.
 *
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 18:23
 */

include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];

//TODO store consumer key and secret in database
$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

include 'insert_credentials.php';

$db_connection->close();

?>