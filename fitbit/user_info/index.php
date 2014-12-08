<?php
/**
 * Created by PhpStorm.
<<<<<<< HEAD
 * User: johannesweber
 * Date: 07.12.14
 * Time: 12:25
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

=======
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */
>>>>>>> fitbit_pa_tv
include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

<<<<<<< HEAD
include 'select/select_user_info.php';

$db_connection->close();
=======
include '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

include 'insert/insert_user_info.php';

$db_connection->close();

?>
>>>>>>> fitbit_pa_tv
