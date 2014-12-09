<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:48
 */


$fetch = "SELECT id FROM measurement WHERE name='time in bed'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_result = $db_connection->getResultAsArray();

$timeInBedId = $fetch_result['id'];

?>