<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 13:44
 */

// Unix Zeit umwandeln
$timestamp = time();
$time = date("H:i", $timestamp);

$response = $withings->getSleepSummary();
print_r($response);

$succesfull = true;

$sleepSummaryArray = $response->body->series;

// get all id's wich are neccessary
$wakeUpDurationMeasurement = 'wakeUpDuration';
$wakeUpDurationId = $db_connection->getMeasurementId($wakeUpDurationMeasurement);
$lightSleepDurationMeasurement = 'lightSleepSuration';
$lightSleepDurationId = $db_connection->getMeasurementId($lightSleepDurationMeasurement);
$deepSleepDurationMeasurement = 'deepSleepSuration';
$deepSleepDurationId = $db_connection->getMeasurementId($deepSleepDurationMeasurement);
$measurement = 'durationToSleep';
$durationToSleepId = $db_connection->getMeasurementId($measurement);
$wakeUpCountMeasurement = 'wakeUpCount';
$wakeUpCountId = $db_connection->getMeasurementId($wakeUpCountMeasurement);
$measurement = 'sleepStartTime';
$sleepStartTimeMeasurementId = $db_connection->getMeasurementId($measurement);


for ($i = 0; $i < sizeof($sleepSummaryArray); $i++) {

    /*$startTime = date("H:i", $sleepSummaryArray[$i]->startdate); // get the Unix timestamp and change it in real Time
    $endTime = date("H:i", $sleepSummaryArray[$i]->enddate);*/
    $date = $sleepSummaryArray[$i]->date;

    // method call to insert
    /*  $result = $db_connection->insertSleepStartTime($userId, $company, $sleepStartTimeMeasurementId, $startTime, $endTime, $date);
  */
    // Zugriff auf response value
    $wakeUpDuration = $withings->devideSeconds($sleepSummaryArray[$i]->data->wakeupduration);
    $lightSleepDuration = $withings->devideSeconds($sleepSummaryArray[$i]->data->lightsleepduration);
    $deepSleepDuration = $withings->devideSeconds($sleepSummaryArray[$i]->data->deepsleepduration);
    $durationToSleep = $withings->devideSeconds($sleepSummaryArray[$i]->data->durationtosleep);
    $wakeUpCount = $withings->devideSeconds($sleepSummaryArray[$i]->data->wakeupcount);

    // Methoden Aufruf, um Daten in Datenbank zu schreiben
    // $result = $db_connection->insertValue($userId, $company, $wakeUpDurationMeasurement, $date, $wakeUpDuration);
    $result = $db_connection->insertValue($userId, $company, $lightSleepDurationMeasurement, $date, $lightSleepDuration);
    $result = $db_connection->insertValue($userId, $company, $deepSleepDurationMeasurement, $date, $deepSleepDuration);
    //$result = $db_connection->insertValue($userId, $company, $durationToSleepId, $date, $durationToSleep);
    $result = $db_connection->insertValue($userId, $company, $wakeUpCountMeasurement, $date, $wakeUpCount);


  Test 12 Test
}



?>
