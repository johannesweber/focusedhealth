<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 30.11.14
 * Time: 13:06
 */



$timestamp = time();
$datum = date("Y-m-d", $timestamp);

include '../../id/find_company_id.php';
include '../../id/find_body_fat_id.php';


$response = $fitbit->getBodyFat($datum);
print_r($response);


$arrayLenght = $response->fat;
$arrayLenght = sizeof($arrayLenght);

for ($x = 0; $x < $arrayLenght; $x++) {

    $fat = $response->fat[$x]->fat;
    $date = $response->fat[$x]->date;


    //SQL Statement to
    $select_weight = "SELECT * FROM value WHERE user_id='$userId' AND measurement_id='$fatId' AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select_weight);
    $rowCount = $result->num_rows;

//weight was not inserted today
    if ($rowCount == 0) {


//SQL Statement to insert data into value table
$insert_fat = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
        VALUES ('$userId', '$fatId', '$company_id', '$fat','$date')";

$db_connection->executeStatement($insert_fat);


} else {


        $update_fat = "UPDATE value set value = '$fat'
                                     WHERE user_id='$userId' AND measurement_id='$fatId' AND company_id='$company_id' AND date = '$datum'";

        $db_connection->executeStatement($update_fat);



    }

}

?>