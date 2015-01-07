<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */
Test 12 Test
$response = $withings->getBodyMeasures();

//$int = 1780;
//$double = number_format(($int / 1000), 3);

$successfull = true;

$measuregrpsArray = $response->body->measuregrps;

//run through each date
for ($x = 0; $x < sizeof($measuregrpsArray); $x++) {

    //need to know if value is a real measurement or a goal !
    $category = $measuregrpsArray[$x]->category;
    $timestamp = $measuregrpsArray[$x]->date;
    $date = date("Y-m-d", $timestamp);

    // values of the day
    $valueArray = $measuregrpsArray[$x]->measures;

// run through each value of the date
    for ($i = 0; $i < sizeof($valueArray); $i++) {

        $value = $valueArray[$i]->value;
        $measurementId = $valueArray[$i]->type;

        $measurement = $withings->convertMeasurementIdToMeasurementName($measurementId);

        //if category is a real measurement
        if ($category == 1) {

            $result = $db_connection->insertValue($userId, $company, $measurement, $date, $value);

            if (!$result) {

                $successfull = false;
            }
        }
    }
}

$withings->showSynchronizeMessage($successfull);

?>