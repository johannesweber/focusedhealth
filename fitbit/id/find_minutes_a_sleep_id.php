<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.12.14
 * Time: 13:58
 */

$fetch = "SELECT id FROM measurement WHERE name='minutesAsleep'";
$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$minutesAsleepId = $fetch_result['id'];

?>