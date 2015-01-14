<?php
/**
 *
 * This Class is used to retrieve and store the manufacturer's data in our database. We get a summary of our sleep activity.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 13:44
 */

// Methodenaufruf
$response = $withings->getSleepSummary();


$sleepSummaryArray = $response->body->series;

// get all measure names wich are neccessary
$wakeUpDurationMeasurement = 'wakeUpDuration';
$lightSleepDurationMeasurement = 'lightlySleepDuration';
$deepSleepDurationMeasurement = 'deepSleepDuration';
$durationToSleepMeasurement = 'durationToSleep';
$wakeUpCountMeasurement = 'awakeningsCount';
$measurement = 'sleepStartTime';
$sleepStartTimeMeasurementId = $db_connection->getMeasurementId($measurement);

//run through each date
for ($i = 0; $i < sizeof($sleepSummaryArray); $i++) {

    $startTime = date("H:i", $sleepSummaryArray[$i]->startdate); // get the Unix timestamp and change it in real Time (hours and minutes)
    $endTime = date("H:i", $sleepSummaryArray[$i]->enddate);
    $date = $sleepSummaryArray[$i]->date;

    // method call to insert
      $result = $db_connection->insertSleepStartTime($userId, $company, $sleepStartTimeMeasurementId, $startTime, $endTime, $date);

    // access response value
    $wakeUpDuration = $withings->devideSeconds($sleepSummaryArray[$i]->data->wakeupduration);
    $lightSleepDuration = $withings->devideSeconds($sleepSummaryArray[$i]->data->lightsleepduration);
    $deepSleepDuration = $withings->devideSeconds($sleepSummaryArray[$i]->data->deepsleepduration);
    $durationToSleep = $withings->devideSeconds($sleepSummaryArray[$i]->data->durationtosleep);
    $wakeUpCount = $withings->devideSeconds($sleepSummaryArray[$i]->data->wakeupcount);

    // Methoden Aufruf, um Daten in Datenbank zu schreiben
    $result = $db_connection->insertValue($userId, $company, $wakeUpDurationMeasurement, $date, $wakeUpDuration);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $lightSleepDurationMeasurement, $date, $lightSleepDuration);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $deepSleepDurationMeasurement, $date, $deepSleepDuration);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $durationToSleepMeasurement, $date, $durationToSleep);
    if (!$result) {

        $successfull = false;
    }
    $result = $db_connection->insertValue($userId, $company, $wakeUpCountMeasurement, $date, $wakeUpCount);
    if (!$result) {

        $successfull = false;
    }


}



?>
