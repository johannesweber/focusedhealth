<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 29.11.14
 * Time: 17:35
 */


$timestamp = time();
$date = date("Y-m-d", $timestamp);

// to get the name for the measurement
$measurementName = 'calories';
$caloriesId = $db_connection->getMeasurementId($measurementName);


$period = 'daily';
$periodDailyId = $db_connection->getPeriodId($period);


$response = $fitbit->getFoodGoal();


$calories = $response->goals->calories;


//SQL Statement to check if this data set already exists
$select = "SELECT * FROM food_plan WHERE user_id='$userId' AND company_id='$companyId'";
$result = $db_connection->executeStatement($select);

if (!$result) {
    $error = false;
}

$rowCount = $result->num_rows;

//food plan was not inserted
if ($rowCount == 0) {
    $insert_food_plan = "INSERT INTO food_plan (user_id, calories_goal, measurement_id, start_date, period_id,  company_id)
         VALUES ('$userId', '$calories', '$caloriesId', '$date', '$periodDailyId', '$companyId')";
    $db_connection->executeStatement($insert_food_plan);
} else {
    $update = "UPDATE food_plan SET calories_goal = '$calories',start_date = '$date'
                                     WHERE user_id='$userId' AND company_id='$companyId'";
    $result = $db_connection->executeStatement($update);
    if (!$result) {
        $error = false;
    }
}

?>
