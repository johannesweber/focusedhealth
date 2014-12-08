<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 15:12
 */


include '../../id/find_company_id.php';
include '../../id/find_weight_id.php';


<<<<<<< HEAD
$response = $fitbit->getTimeSeries("weight", "today", "7d");
print_r($response);


$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


=======
<<<<<<< HEAD

include 'find_company_id.php';
include 'find_weight_id.php';



$response = $fitbit->getTimeSeries("weight","today","7d");
print_r($response);






  $arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);




=======
$response = $fitbit->getTimeSeries("weight", "today", "7d");
print_r($response);


$arrayLenght = $response;
$arrayLenght = sizeof($arrayLenght);


>>>>>>> FETCH_HEAD
>>>>>>> fitbit_pa_tv
$array = $response;

for ($x = 0; $x < $arrayLenght; $x++) {

    $weight = $array[$x]->value;
    $date = $array[$x]->dateTime;
<<<<<<< HEAD
=======
<<<<<<< HEAD


=======
>>>>>>> FETCH_HEAD
>>>>>>> fitbit_pa_tv


    //SQL Statement to
    $select_weight = "SELECT * FROM value WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_weight);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
        $insert_weight = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('42', '$weightId', '$company_id', '$weight','$date')";

        $db_connection->executeStatement($insert_weight);


<<<<<<< HEAD
    }  else {
=======
<<<<<<< HEAD
    } /* else {

        $update_weight = "UPDATE value set value = '$weight'
                                     WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$datum'";
=======
    }  else {
>>>>>>> FETCH_HEAD
>>>>>>> fitbit_pa_tv

        $update = "UPDATE value SET value = '$weight'
                                     WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id' AND date = '$date'";

        $db_connection->executeStatement($update);

<<<<<<< HEAD
=======
<<<<<<< HEAD
    } */
=======
>>>>>>> fitbit_pa_tv

    }
>>>>>>> FETCH_HEAD

}

?>