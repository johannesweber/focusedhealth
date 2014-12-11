<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:51
 */

$fetch_bmiId = "SELECT id FROM measurement WHERE name='Elevation'";

$fetch_bmiId_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_bmiId_result = $db_connection->getResultAsArray();

$elevationId = $fetch_bmiId_result['id'];

?>