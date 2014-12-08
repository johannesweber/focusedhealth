<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.12.14
 * Time: 14:12
 */

$fetch = "SELECT id FROM measurement WHERE name='minutesToFallAsleep'";
$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$minutesToFallAsleepId = $fetch_result['id'];

?>