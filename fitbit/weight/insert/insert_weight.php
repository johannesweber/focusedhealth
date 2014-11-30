<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 30.11.14
 * Time: 13:06
 */



$timestamp = time();
$datum = date("Y-m-d", $timestamp);

include '../../id/find_company_id.php';
include 'find_weight_id.php';
include 'find_bmi_id.php';

$response = $fitbit->getWeight($datum);
print_r($response);


$arrayLenght = $response->weight;
$arrayLenght = sizeof($arrayLenght);

for ($x = 0; $x < $arrayLenght; $x++) {

    $weight = $response->weight[$x]->weight;
    $bmi = $response->weight[$x]->bmi;
    $date = $response->weight[$x]->date;

//SQL Statement to insert data into value table
$insert_weight = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$weightId', '$company_id', '$weight','$date'),
                ('42', '$bmiId', '$company_id', '$bmi','$date')";

$db_connection->executeStatement($insert_weight);


}



?>