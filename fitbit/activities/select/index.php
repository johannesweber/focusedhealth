<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 05.12.14
 * Time: 10:56
 */

include '../../../db_connection.php';


$db_connection = new DatabaseConnection();

$db_connection->connect();
include '../../id/find_weight_id.php';

$fetch = "SELECT activity, date, start_time, duration, distance, calories, description FROM activity WHERE user_id='42' ";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();

print_r($result);

?>