<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 01.12.14
 * Time: 14:35
 *
 * to insert food
 */


$timestamp = time();
$datum = date("Y-m-d", $timestamp);

$error = true;

$response = $fitbit->getFoods($datum);


$arrayLenght = $response->foods;
$arrayLenght = sizeof($arrayLenght);

//run through each food
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




    $result = $db_connection->insertFood($userId, $company, $date, $amount, $brand, $name, $unit, $calories, $carbs, $fat, $fiber, $protein, $sodium);


    if (!$result) {

        $successfull = false;
    }

}


?>



