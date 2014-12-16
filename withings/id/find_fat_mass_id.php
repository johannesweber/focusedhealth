<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:29
 */

$fetch = "SELECT id FROM measurement WHERE name='Fat Mass'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$fatMassId = $fetch_result['id'];
?>