<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:45
 */

$fetch_thighId = "SELECT id FROM measurement WHERE name='Thigh'";

$fetch_thighId_mysqli_result = $db_connection->executeStatement($fetch_thighId);
$fetch_thighId_result = $db_connection->getResultAsArray();

$thighId = $fetch_thighId_result['id'];
?>