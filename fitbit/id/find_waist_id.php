<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:45
 */

$fetch_waistId = "SELECT id FROM measurement WHERE name='Waist'";

$fetch_waistId_mysqli_result = $db_connection->executeStatement($fetch_waistId);
$fetch_waistId_result = $db_connection->getResultAsArray();

$waistId = $fetch_waistId_result['id'];
?>