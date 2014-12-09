<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 26.11.14
 * Time: 14:51
 */

$fetch_stepsId = "SELECT id FROM measurement WHERE name='Steps'";

$fetch_stepsId_mysqli_result = $db_connection->executeStatement($fetch_stepsId);
$fetch_stepsId_result = $db_connection->getResultAsArray();

$stepsId = $fetch_stepsId_result['id'];

?>