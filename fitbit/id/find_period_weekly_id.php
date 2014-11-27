<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 16:14
 */



$fetch_periodWeeklyId = "Select id FROM period where period = 'weekly' ";

$fetch_periodWeeklyId_mysqli_result = $db_connection->executeStatement($fetch_periodWeeklyId);
$fetch_periodWeeklyId_result = $db_connection->getResultAsArray();

$periodWeeklyId = $fetch_periodWeeklyId_result['id'];
?>