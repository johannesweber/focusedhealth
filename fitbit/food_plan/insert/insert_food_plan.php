<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 29.11.14
 * Time: 17:35
 */


$timestamp=time();
$date=date("Y-m-d", $timestamp);

$response = $fitbit->getFoodGoal();
print_r($response);

$calories = $response->goals->calories;
//ist nicht in der response vorhanden
$estimateDate = $response->foodPlan->estimateDate;
$intensity = $response->foodPlan->intensity;



include '../id/find_company_id.php';
include '../id/find_period_daily_id.php';   // geht von index aus
include '../id/find_calories_id.php';       // geht von index aus

//SQL Statement to insert data into value table
$select_food_plan = "SELECT * FROM food_plan WHERE user_id='42' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_food_plan);
 $rowCount = $result->num_rows;

if ($rowCount == 0) {
    $insert_food_plan = "INSERT INTO food_plan (user_id, calories_goal, measurement_id, start_date, estimate_date, intensity, period_id,  company_id)
         VALUES ('42', '$calories', '$caloriesId', '$date', '$estimateDate', '$intensity', '$periodDailyId', '$company_id')";
    $db_connection->executeStatement($insert_food_plan);
} else {
    $update_food_plan = "UPDATE food_plan SET calories_goal = '$calories',start_date = '$date', estimate_date = '$estimateDate' , intensity = '$intensity'
                                     WHERE user_id='42' AND company_id='$company_id'";
    $db_connection->executeStatement($update_food_plan);
}

?>