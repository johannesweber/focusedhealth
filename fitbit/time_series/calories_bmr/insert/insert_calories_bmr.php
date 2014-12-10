<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 14:37
 */



include '../../id/find_company_id.php';
include '../../id/find_calories_bmr_id.php';



$response = $fitbit->getTimeSeries("caloriesBMR","today","7d");//achtung geht nicht
print_r($response);




$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $caloriesBMR = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select_caloriesBMR = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$caloriesBMRId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_caloriesBMR);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_bmi = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$caloriesBMRId', '$company_id', '$caloriesBMR','$date')";

        $db_connection->executeStatement($insert_bmi);


    } /* else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='$userId' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


    } */

}

?>