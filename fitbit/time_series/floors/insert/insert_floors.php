<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 03.12.14
 * Time: 15:51
 */


include '../../id/find_company_id.php';
include '../../id/find_floors_id.php';



$response = $fitbit->getTimeSeries("floors","today","7d");
print_r($response);




$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $floors = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
    $select = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$floorsId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_bmi = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$floorsId', '$company_id', '$floors','$date')";

        $db_connection->executeStatement($insert_bmi);


    }  else {

        $update_weight = "UPDATE value set value = '$floors'
                                     WHERE user_id='42' AND measurement_id='$floorsId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


    }

}

?>