<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:47
 */

$fetch_caloriesId = "SELECT id FROM measurement WHERE name='Calories'";

$fetch_caloriesId_mysqli_result = $db_connection->executeStatement($fetch_caloriesId);
$fetch_caloriesId_result = $db_connection->getResultAsArray();

$caloriesId = $fetch_caloriesId_result['id'];

?>