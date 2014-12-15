<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:27
 */

$fetch = "SELECT id FROM measurement WHERE name='fatFreeMass'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$fatFreeMassId = $fetch_result['id'];
?>