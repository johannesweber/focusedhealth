<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.12.14
 * Time: 14:05
 */
$fetch = "SELECT id FROM measurement WHERE name='Minutes Awake'";
$fetch_mysqli_result = $db_connection->executeStatement($fetch);
$fetch_result = $db_connection->getResultAsArray();

$minutesAwakeId = $fetch_result['id'];

?>