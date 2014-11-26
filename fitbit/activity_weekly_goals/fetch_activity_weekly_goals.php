<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 17:05
 */
/**
 * this class gets all important credentials from fitbit. This credentials are required to send Requests to Fitbit API
 *
 *
 * Created by PhpStorm.
 * User: patricauer
 * Date: 25.11.14
 * Time: 18:05
 */

include 'find_company_id.php';

//TODO user id from focusedhealth required

$fetch_activityDistanceId = "SELECT id FROM measurement WHERE name='Distance'";
$fetch_activityStepsId = "SELECT id FROM measurement WHERE name='Steps'";
$fetch_periodId = "Select id FROM period where period = 'weekly' ";


$fetch_activityDistanceId_mysqli_result = $db_connection->executeStatement($fetch_activityDistanceId);
$fetch_activityDistanceId_result = $db_connection->getResultAsArray();

$fetch_activityStepsId_mysqli_result = $db_connection->executeStatement($fetch_activityStepsId);
$fetch_activityStepsId_result = $db_connection->getResultAsArray();

$fetch_periodId_mysqli_result = $db_connection->executeStatement($fetch_periodId);
$fetch_periodId_result = $db_connection->getResultAsArray();


$activityDistanceId = $fetch_activityDistanceId_result['id'];
$activityStepsId = $fetch_activityStepsId_result['id'];
$periodId = $fetch_periodId_result['id'];



?>