<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 14.01.15
 * Time: 13:36
 */


error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

// data send by phone
$userId = $_GET['userId'];


$result = $db_connection->deleteUser($userId);

if ($result) {

    echo '{"success" : "1", "message" : "User successfully deleted"}';

} else {

    echo '{"success" : "-1", "message" : "User was not deleted"}';
}

$db_connection->close();

?>