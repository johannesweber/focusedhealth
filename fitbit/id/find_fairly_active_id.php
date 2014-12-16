<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:30
 */

$fetch = "SELECT id FROM measurement WHERE name='Fairly Active'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$fairlyActiveId = $fetch_result['id'];

?>