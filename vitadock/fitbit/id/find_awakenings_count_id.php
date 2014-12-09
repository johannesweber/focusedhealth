<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.12.14
 * Time: 13:42
 */

$fetch = "SELECT id FROM measurement WHERE name='awakeningsCount'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$awakeningsCountId = $fetch_result['id'];

?>