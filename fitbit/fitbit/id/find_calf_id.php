<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:46
 */

$fetch_calfId = "SELECT id FROM measurement WHERE name='Calf'";

$fetch_calfId_mysqli_result = $db_connection->executeStatement($fetch_calfId);
$fetch_calfId_result = $db_connection->getResultAsArray();

$calfId = $fetch_calfId_result['id'];
?>