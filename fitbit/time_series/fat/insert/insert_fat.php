<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 12:10
 */
include '../../id/find_company_id.php';
include '../../id/find_body_fat_id.php';



$response = $fitbit->getTimeSeries("fat","today","7d");
print_r($response);




echo $arrayLenght = $response;
echo $arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $fat = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select_fat = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$fatId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_fat);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_fat = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$fatId', '$company_id', '$fat','$date')";

        $db_connection->executeStatement($insert_fat);


    } /* else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


    } */

}

?>