<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getWater($date);

print_r($response);

$water = $response->summary->water;



include 'fetch_get_water.php';

//SQL Statement to insert data into value table
$insert_water = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('42', '$waterId', '$company_id', '$water',NULL)";

$db_connection->executeStatement($insert_water);

?>