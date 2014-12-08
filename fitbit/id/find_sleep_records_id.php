<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:49
 */

$fetch = "SELECT id FROM measurement WHERE name='sleep records'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_result = $db_connection->getResultAsArray();

$sleepRecordsId = $fetch_result['id'];