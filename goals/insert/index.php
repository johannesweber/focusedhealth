<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 28.12.14
 * Time: 17:14
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

$db_connection = new DatabaseConnection();

$db_connection->connect();

$userId = $_GET["userId"];
$measurement = $_GET["measurement"];
$measurementId = $db_connection->getMeasurementId($measurement);
$period = $_GET["period"];
$startDate = $_GET["startDate"];
$company = $_GET["company"];
$companyId = $db_connection->getCompanyId($company);
$goalValue = $_GET["goalValue"];

$timestamp = time();
$date = date("Y-m-d", $timestamp);

//get correct limit value for goal
$limit = 1;

$db_connection->selectGoalFromDatabase($measurement, $userId, $period, $limit);

$result = $db_connection->getResult();

if ($result->num_rows == 0 ) {

    //TODO was ist das StartValue ? Braucht man das ? ist ja überall NULL ?!?
    $statement = "INSERT INTO goal (goal_value, start_value, startdate, period, user_id, measurement_id, company_id)
                VALUES ('$goalValue', '0', '$date', '$period', '$userId', '$measurementId', '$companyId')";

} else {

    $resultArray = $db_connection->getResultAsArray();
    $goalId = $resultArray["goal_id"];

    $statement = "UPDATE goal
                  SET goal_value = $goalValue, start_value = 0, startdate = $date, period = $period, user_id = $userId, measurement_id = $measurementId, company_id = $companyId
                  WHERE period = $period AND measurement_id = $measurementId AND user_id = $userId
                  ";
}

$result = $db_connection->executeStatement($statement);

if ($result) {

    echo '{"success" : "1", "message" : "Goal successfully inserted"}';

} else {

    echo '{"success" : "-1", "message" : "Goal was not successfully inserted"}';

}

$db_connection->close();

?>