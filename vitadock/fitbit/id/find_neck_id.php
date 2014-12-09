<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:45
 */

$fetch_neckId = "SELECT id FROM measurement WHERE name='Neck'";

$fetch_neckId_mysqli_result = $db_connection->executeStatement($fetch_neckId);
$fetch_neckId_result = $db_connection->getResultAsArray();

$neckId = $fetch_neckId_result['id'];
?>