<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:46
 */
$fetch_bicepId = "SELECT id FROM measurement WHERE name='Bicep'";

$fetch_bicepId_mysqli_result = $db_connection->executeStatement($fetch_bicepId);
$fetch_bicepId_result = $db_connection->getResultAsArray();

$bicepId = $fetch_bicepId_result['id'];

?>