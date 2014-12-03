<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:06
 */



$response = $fitbit->getWeightGoal();
print_r($response);

$weightGoal = $response->goal->weight;
$startDate = $response->goal->startDate;
$startWeight = $response->goal->startWeight;

echo getcwd();
include '../../id/find_company_id.php';
include '../id/find_weight_id.php';


//SQL Statement to insert data into value table
$select_weight_goal = "SELECT * FROM goal WHERE user_id='42' AND measurement_id='$weightId' AND company_id='$company_id'";
$result = $db_connection->executeStatement($select_weight_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {
    $insert_weight_goal = "INSERT INTO goal (goal_value, start_value, startdate, enddate, period, user_id, measurement_id, company_id)
VALUES ('$weightGoal', '$startWeight', '$startDate', Null, NULL , '42', '$weightId', '$company_id')";
    $db_connection->executeStatement($insert_weight_goal);

} else {

    $update_weight_goal = "UPDATE goal set goal_value='$weightGoal',start_value='$startWeight', startdate='$startDate'
WHERE user_id='42' AND measurement_id='$weightId' and company_id='$company_id'";
    $db_connection->executeStatement($update_weight_goal);

}



?>