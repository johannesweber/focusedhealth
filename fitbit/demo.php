<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 18:23
 */

include_once 'db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

include_once 'receive_credentials.php';

//include_once 'user_info/insert_user_info.php';

$db_connection->close();

?>

