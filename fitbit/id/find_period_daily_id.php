<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 16:11
 */


$fetch_periodDailyId = "Select id FROM period where period = 'daily' ";

$fetch_periodDailyId_mysqli_result = $db_connection->executeStatement($fetch_periodDailyId);
$fetch_periodDailyId_result = $db_connection->getResultAsArray();

$periodDailyId = $fetch_periodDailyId_result['id'];
?>