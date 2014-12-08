<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:12
 */

include '../../../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();


include '../../../id/find_body_fat_id.php';


$fetch = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$fatId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);
?>