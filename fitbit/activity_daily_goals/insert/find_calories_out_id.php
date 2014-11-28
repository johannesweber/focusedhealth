<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 17:34
 */
$fetch_caloriesOutId = "SELECT id FROM measurement WHERE name='CaloriesOut'";

$fetch_caloriesOutId_mysqli_result = $db_connection->executeStatement($fetch_caloriesOutId);
$fetch_caloriesOutId_result = $db_connection->getResultAsArray();

$caloriesOutId = $fetch_caloriesOutId_result['id'];

?>