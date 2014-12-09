<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:46
 */

$fetch_fatId = "SELECT id FROM measurement WHERE name='Body Fat'";

$fetch_fatId_mysqli_result = $db_connection->executeStatement($fetch_fatId);
$fetch_fatId_result = $db_connection->getResultAsArray();

$fatId = $fetch_fatId_result['id'];
?>