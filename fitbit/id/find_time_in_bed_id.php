<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:48
 */


$fetch_bmiId = "SELECT id FROM measurement WHERE name='time in bed'";

$fetch_bmiId_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_bmiId_result = $db_connection->getResultAsArray();

$timeInBedId = $fetch_bmiId_result['id'];

?>