<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 17:36
 */


$fetch_distanceId = "SELECT id FROM measurement WHERE name='Distance'";

$db_connection->executeStatement($fetch_distanceId);
$fetch_distanceId_result = $db_connection->getResultAsArray();

$distanceId = $fetch_distanceId_result['id'];

?>