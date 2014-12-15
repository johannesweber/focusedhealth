<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:32
 */

$fetch = "SELECT id FROM measurement WHERE name='pulse'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$pulseId = $fetch_result['id'];
?>