<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 14:24
 */




include '../../id/find_company_id.php';
include '../../id/find_calories_out_id.php';



$response = $fitbit->getTimeSeries("caloriesOut","today","7d");




$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $calories = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select_calories = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$caloriesOutId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_calories);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_bmi = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$caloriesOutId', '$company_id', '$calories','$date')";

        $db_connection->executeStatement($insert_bmi);


    }  else {

        $update = "UPDATE value SET value = '$calories'
                                     WHERE user_id='$userId' AND measurement_id='$caloriesOutId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>