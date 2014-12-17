<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 02.12.14
 * Time: 18:00
 */


$measurementId = getMeasurementId($measurement, $db_connection);


$db_connection->selectValueFromDatabase($stepsId, $userId, $date, $limit);


?>

