<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:42
 */

$fetch = "SELECT id FROM measurement WHERE name='SpO2'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$spO2Id = $fetch_result['id'];
?>