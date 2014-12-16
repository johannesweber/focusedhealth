<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 14:41
 */

$fetch_bmiId = "SELECT id FROM measurement WHERE name='Calories BMR'";

$fetch_bmiId_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_bmiId_result = $db_connection->getResultAsArray();

$CaloriesBMRId = $fetch_bmiId_result['id'];

?>