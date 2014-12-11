<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 08.12.14
 * Time: 17:39
 */


$fetch = "SELECT id FROM measurement WHERE name='sleepStartTime'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$sleepStartTimeId = $fetch_result['id'];

?>