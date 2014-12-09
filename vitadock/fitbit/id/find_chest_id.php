<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:46
 */

$fetch_chestId = "SELECT id FROM measurement WHERE name='Chest'";

$fetch_chestId_mysqli_result = $db_connection->executeStatement($fetch_chestId);
$fetch_chestId_result = $db_connection->getResultAsArray();

$chestId = $fetch_chestId_result['id'];
?>