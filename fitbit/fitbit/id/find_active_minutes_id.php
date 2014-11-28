<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:51
 */
$fetch_activeMinutesId = "SELECT id FROM measurement WHERE name='Active Minutes'";

$fetch_activeMinutesId_mysqli_result = $db_connection->executeStatement($fetch_activeMinutesId);
$fetch_activeMinutesId_result = $db_connection->getResultAsArray();

$activeMinutesId = $fetch_activeMinutesId_result['id'];

?>