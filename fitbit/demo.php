<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 18.11.14
 * Time: 18:23
 */

include 'db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

include_once 'insert_credentials.php';

include 'user_info/insert_user_info.php';

$db_connection->close();

?>