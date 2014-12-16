<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:31
 */


$fetch = "SELECT id FROM measurement WHERE name='Very Active'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

 $veryActiveId = $fetch_result['id'];

?>