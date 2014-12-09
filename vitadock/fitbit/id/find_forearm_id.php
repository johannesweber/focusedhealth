<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:47
 */

$fetch_forearmId = "SELECT id FROM measurement WHERE name='Forearm'";

$fetch_forearmId_mysqli_result = $db_connection->executeStatement($fetch_forearmId);
$fetch_forearmId_result = $db_connection->getResultAsArray();

$forearmId = $fetch_forearmId_result['id'];
?>