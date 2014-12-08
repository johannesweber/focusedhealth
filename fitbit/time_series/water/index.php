<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:53
 */

<<<<<<< HEAD
error_reporting(E_ALL);
ini_set('display_errors', 'On');
=======
>>>>>>> fitbit_pa_tv

include '../../../db_connection.php';

include '../../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

<<<<<<< HEAD
include 'fetch_credentials.php';
=======
include '../../fetch_credentials.php';
>>>>>>> fitbit_pa_tv

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

<<<<<<< HEAD
include 'insert_water.php';

include_once 'select_water.php';
=======
include 'insert/insert_water.php';
>>>>>>> fitbit_pa_tv

$db_connection->close();

?>