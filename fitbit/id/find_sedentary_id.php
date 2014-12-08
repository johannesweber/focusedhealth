<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:25
 */


$fetch = "SELECT id FROM measurement WHERE name='Sedentary'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$sedentaryId = $fetch_result['id'];

?>