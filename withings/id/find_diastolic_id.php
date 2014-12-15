<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:39
 */

$fetch = "SELECT id FROM measurement WHERE name='Diastolic'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$diastolicId = $fetch_result['id'];
?>