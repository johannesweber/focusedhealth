<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 07.12.14
 * Time: 14:13
 */

$fetch_waterId = "SELECT id FROM user WHERE name='Water'";

$fetch_waterId_mysqli_result = $db_connection->executeStatement($fetch_waterId);
$fetch_waterId_result = $db_connection->getResultAsArray();


$waterId = $fetch_waterId_result['id'];