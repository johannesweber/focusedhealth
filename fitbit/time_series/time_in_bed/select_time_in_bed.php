<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */




include '../../id/find_time_in_bed_id.php';


$fetch = "SELECT value, date FROM value WHERE user_id='42' AND measurement_id = '$timeInBedId'";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();


print_r($result);
?>