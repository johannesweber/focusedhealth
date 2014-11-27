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

$water = $response->summary->water;
<<<<<<< HEAD:fitbit/water/insert_water.php
<<<<<<< HEAD
$waterArray = $response->water[0];
=======
>>>>>>> fitbit_id:fitbit/water/insert/insert_water.php

<<<<<<< HEAD:fitbit/water/insert/insert_water.php
include '../../id/find_water_id.php';
include '../../id/find_company_id.php';

<<<<<<< HEAD:fitbit/water/insert_water.php
include 'fetch_get_water.php';
=======

include 'find_water_id.php';
>>>>>>> master
=======
=======
include 'find_water_id.php';
>>>>>>> master:fitbit/water/insert_water.php
>>>>>>> fitbit_id:fitbit/water/insert/insert_water.php

//SQL Statement to insert data into value table
$insert_water = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('42', '$waterId', '$company_id', '$water', NULL)";

$db_connection->executeStatement($insert_water);


