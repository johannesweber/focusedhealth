<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 07.12.14
 * Time: 12:25
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../../db_connection.php';

include '../fitbitphp.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

include 'select/select_user_info.php';

$db_connection->close();
