<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 15.12.14
 * Time: 15:25
 */

$fetch = "SELECT id FROM measurement WHERE name='height'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();


 $heightId = $fetch_result['id'];
?>