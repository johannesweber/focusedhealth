<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */





include 'find_company_id.php';
include 'find_weight_id.php';

echo("####");

$response = $fitbit->getWeightSeries();
print_r($response);

/*
$arrayLenght = $response->body-weight;
$arrayLenght = sizeof($arrayLenght);


for ($x = 0; $x < $arrayLenght; $x++) {

    $weight = $response->bodyWeight[$x]->value;
    $date = $response->bodyWeight[$x]->dateTime;


    //SQL Statement to
    $select_weight = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_weight);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_weight = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$weightId', '$company_id', '$weight','$date'),
                ('42', '$bmiId', '$company_id', '$bmi','$date')";

        $db_connection->executeStatement($insert_weight);


    } else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


        $update_weight = "UPDATE value set value = '$bmi'
                                     WHERE user_id='42' AND measurement_id='$bmiId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);

    }

}
*/
?>