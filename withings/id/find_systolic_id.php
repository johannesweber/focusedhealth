<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:40
 */

$fetch = "SELECT id FROM measurement WHERE name='Systolic'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$systolicId = $fetch_result['id'];
?>