<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */




<<<<<<< HEAD
echo(getcwd());
=======
>>>>>>> FETCH_HEAD
include '../../id/find_company_id.php';
include '../../id/find_bmi_id.php';



$response = $fitbit->getTimeSeries("bmi","today","7d");
print_r($response);




<<<<<<< HEAD
 $arrayLenght = $response;
 $arrayLenght = sizeof($arrayLenght);
=======
$arrayLength = $response;
$arrayLength = sizeof($arrayLength);
>>>>>>> FETCH_HEAD


$array = $response;

<<<<<<< HEAD
for ($x = 0; $x < $arrayLenght; $x++) {
=======
for ($x = 0; $x < $arrayLength; $x++) {
>>>>>>> FETCH_HEAD

    $bmi = $array[$x]->value;
    $date = $array[$x]->dateTime;




    //SQL Statement to
<<<<<<< HEAD
    $select_bmi = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$bmiId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_bmi);
=======
    $select = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$bmiId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
>>>>>>> FETCH_HEAD
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
<<<<<<< HEAD
        $insert_bmi = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$bmiId', '$company_id', '$bmi','$date')";

        $db_connection->executeStatement($insert_bmi);


    } /* else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_weight);


    } */
=======
        $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$bmiId', '$company_id', '$bmi','$date')";

        $db_connection->executeStatement($insert);


    }  else {

        $update = "UPDATE value SET value = '$bmi'
                                     WHERE user_id='42' AND measurement_id='$bmiId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);


    }
>>>>>>> FETCH_HEAD

}

?>