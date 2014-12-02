<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:44
 */

$fetch_weightId = "SELECT id FROM measurement WHERE name='Weight'";

$fetch_weightId_mysqli_result = $db_connection->executeStatement($fetch_weightId);
$fetch_weightId_result = $db_connection->getResultAsArray();

$weightId = $fetch_weightId_result['id'];
?>