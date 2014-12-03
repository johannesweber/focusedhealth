<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 15:03
 */

include '../../id/find_company_id.php';
include '../../id/find_steps_id.php';



$response = $fitbit->getTimeSeries("steps","today","7d");
print_r($response);




$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $steps = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select_steps = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$stepsId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_steps);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$stepsId', '$company_id', '$steps','$date')";

        $db_connection->executeStatement($insert);


    } /* else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


    } */

}

?>