<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:51
 *
 * insert calories in of a specific time range
 */


include '../../id/find_company_id.php';
include '../../id/find_calories_id.php';

//Request for time series awakenings count
$response = $fitbit->getTimeSeries("caloriesIn", "today", "7d");

//lenght of response array
$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

//loop to insert all data from response array
for ($x = 0; $x < $arrayLenght; $x++) {

//access data of array
    $caloriesIn = $array[$x]->value;
    $date = $array[$x]->dateTime;


//SQL Statement to check if this data set already exists for this day
    $select_calories = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$caloriesId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_calories);
    $rowCount = $result->num_rows;

//calories in was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into table called value
        $insert_calories = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$caloriesId', '$company_id', '$caloriesIn','$date')";

        $db_connection->executeStatement($insert_calories);

//awakenings count was already inserted today
    }  else {

        //SQL Statement to update data
        $update = "UPDATE value SET value = '$caloriesIn'
                   WHERE user_id='42' AND measurement_id='$caloriesId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }

}
//insert awakenings count of a specific time range
//Request for time series awakenings count
//lenght of response array
//loop to insert all data from response array
//access data of array
//SQL Statement to check if this data set already exists for this day
//awakenigns count was not inserted today
//SQL Statement to insert data into table called value
//awakenings count was already inserted today
//SQL Statement to update data

?>