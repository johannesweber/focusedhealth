<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 16:28
 */

$fetch = "SELECT id FROM measurement WHERE name='Lightly Active'";

$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$ligthlyActiveId = $fetch_result['id'];

?>