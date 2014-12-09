<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:51
 */


include '../../id/find_company_id.php';
include '../../id/find_calories_id.php';


$response = $fitbit->getTimeSeries("caloriesIn", "today", "7d");


$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $caloriesIn = $array[$x]->value;
    $date = $array[$x]->dateTime;


    //SQL Statement to
    $select_calories = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$caloriesId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_calories);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_calories = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$caloriesId', '$company_id', '$caloriesIn','$date')";

        $db_connection->executeStatement($insert_calories);


    }  else {

        $update = "UPDATE value SET value = '$caloriesIn'
                                     WHERE user_id='42' AND measurement_id='$caloriesId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}

?>