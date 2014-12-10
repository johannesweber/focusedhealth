<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 01.12.14
 * Time: 14:35
 */




$timestamp = time();
$datum = date("Y-m-d", $timestamp);


// icluding all files which are necessary to get the ids
include '../id/find_company_id.php';


$response = $fitbit->getFoods($datum);
//print_r($response);


$arrayLenght = $response->foods;
$arrayLenght = sizeof($arrayLenght);


for ($x = 0; $x < $arrayLenght; $x++) {

    //access data of array
    $date = $response->foods[$x]->logDate;
    $amount = $response->foods[$x]->loggedFood->amount;
    $brand = $response->foods[$x]->loggedFood->brand;
    $name = $response->foods[$x]->loggedFood->name;
    $unit = $response->foods[$x]->loggedFood->unit->name;
    $calories = $response->foods[$x]->nutritionalValues->calories;
    $carbs = $response->foods[$x]->nutritionalValues->carbs;
    $fat = $response->foods[$x]->nutritionalValues->fat;
    $fiber = $response->foods[$x]->nutritionalValues->fiber;
    $protein = $response->foods[$x]->nutritionalValues->protein;
    $sodium = $response->foods[$x]->nutritionalValues->sodium;



    //SQL Statement to
    $select = "SELECT * FROM food WHERE user_id='42'  AND company_id='$company_id' AND date= '$date' ";
    $result = $db_connection->executeStatement($select);
    $rowCount = $result->num_rows;

//food was not inserted for today
    if ($rowCount == 0) {


    $insert_food = "INSERT INTO food (user_id, company_id, date, amount, brand, name, unit, calories, carbs, fat, fiber, protein, sodium)
                VALUES ('42', '$company_id', '$date', '$amount', '$brand', '$name', '$unit', '$calories', '$carbs', '$fat', '$fiber', '$protein', '$sodium')";

    $db_connection->executeStatement($insert_food);

    }



}


?>