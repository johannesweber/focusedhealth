<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */


$fetch = "SELECT value, date FROM value WHERE user_id='$userId' AND measurement_id = '$timeInBedId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);
?>