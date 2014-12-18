<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 29.11.14
 * Time: 17:35
 */


$timestamp = time();
$date = date("Y-m-d", $timestamp);

$error = true;

// to get the Id's for the measurement name
$measurementName = 'calories';
$caloriesId = $db_connection->getMeasurementId($measurementName);
$measurementName = 'daily';
$periodDailyId = $db_connection->getMeasurementId($measurementName);


$response = $fitbit->getFoodGoal();


$calories = $response->goals->calories;

//ist nicht in der response vorhanden!!
//$estimateDate = $response->foodPlan->estimateDate;

$intensity = $response->foodPlan->intensity;


//SQL Statement to check if this data set already exists
$select = "SELECT * FROM food_plan WHERE user_id='$userId' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select);

if (!$result) {
    $error = false;
}

$rowCount = $result->num_rows;

//food plan was not inserted
if ($rowCount == 0) {
    $insert_food_plan = "INSERT INTO food_plan (user_id, calories_goal, measurement_id, start_date, intensity, period_id,  company_id)
         VALUES ('$userId', '$calories', '$caloriesId', '$date', '$intensity', '$periodDailyId', '$company_id')";
    $db_connection->executeStatement($insert_food_plan);
} else {
    $update = "UPDATE food_plan SET calories_goal = '$calories',start_date = '$date', intensity = '$intensity'
                                     WHERE user_id='$userId' AND company_id='$company_id'";
    $result = $db_connection->executeStatement($update);
    if (!$result) {
        $error = false;
    }
}

if (!$error) {
    echo '{"success" : "-1", "message" : "steps statement was not successfull"}';
} else {
    echo '{"success" : "1", "message" : "steps statement was successfull"}';
}

?>
