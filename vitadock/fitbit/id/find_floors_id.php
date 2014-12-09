<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 15:55
 */


$fetch_bmiId = "SELECT id FROM measurement WHERE name='Floors'";

$fetch_bmiId_mysqli_result = $db_connection->executeStatement($fetch_bmiId);
$fetch_bmiId_result = $db_connection->getResultAsArray();

$floorsId = $fetch_bmiId_result['id'];

?>