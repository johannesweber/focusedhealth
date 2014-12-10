<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 30.11.14
 * Time: 13:06
 */


$timestamp = time();
$datum = date("Y-m-d", $timestamp);

include '../id/find_company_id.php';
include '../id/find_weight_id.php';
include '../id/find_bmi_id.php';

$response = $fitbit->getWeight($datum);
print_r($response);


$arrayLenght = $response->weight;
$arrayLenght = sizeof($arrayLenght);


for ($x = 0; $x < $arrayLenght; $x++) {

    $weight = $response->weight[$x]->weight;
    $bmi = $response->weight[$x]->bmi;
    $date = $response->weight[$x]->date;


    //SQL Statement to
    $select_weight = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$weightId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_weight);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_weight = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$weightId', '$company_id', '$weight','$date'),
                ('$userId', '$bmiId', '$company_id', '$bmi','$date')";

        $db_connection->executeStatement($insert_weight);


    } else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='$userId' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


        $update_weight = "UPDATE value set value = '$bmi'
                                     WHERE user_id='$userId' AND measurement_id='$bmiId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);

    }

}

?>