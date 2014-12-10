<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */

$timestamp = time();
$date = date("Y-m-d", $timestamp);

include '../id/find_company_id.php';
include '../id/find_water_id.php';


$response = $fitbit->getWater($date);
print_r($response);
echo('#####');

$water = $response->summary->water;

//SQL Statement to insert data into value table
$select_water = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$waterId' AND company_id='$company_id' AND date= '$date'";
$result = $db_connection->executeStatement($select_water);
$rowCount = $result->num_rows;

//water was not inserted today
if ($rowCount == 0) {

//SQL Statement to insert data into value table
    $insert_water_summary = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('$userId', '$waterId', '$company_id', '$water', '$date')";

    $db_connection->executeStatement($insert_water_summary);


    $arrayLenght = $response->water;
    $arrayLenght = sizeof($arrayLenght);


    for ($x = 0; $x < $arrayLenght; $x++) {

        $waterArray = $response->water[$x]->amount;

        //SQL Statement to insert data into value table
        $insert_water = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('$userId', '$waterId', '$company_id', '$waterArray', '$date')";

        $db_connection->executeStatement($insert_water);

    }


}





?>