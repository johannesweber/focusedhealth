<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:05
 */

//TODO user id from focusedhealth required
$find_waterId = "SELECT id FROM measurement WHERE name='Water'";

$find_waterId_mysqli_result = $db_connection->executeStatement($find_waterId);

$find_waterId_result = $db_connection->getResultAsArray();

$waterId = $find_waterId_result['id'];

?>