<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:59
 */


include '../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();
include '../../id/find_weight_id.php';

$fetch = "SELECT date, value FROM value WHERE user_id='42' ";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();

print_r($result);

?>