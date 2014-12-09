<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:47
 */

$fetch_hipsId = "SELECT id FROM measurement WHERE name='Hips'";

$fetch_hipsId_mysqli_result = $db_connection->executeStatement($fetch_hipsId);
$fetch_hipsId_result = $db_connection->getResultAsArray();

$hipsId = $fetch_hipsId_result['id'];
?>