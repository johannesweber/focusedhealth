<?php
/**
 *
 * This Class is used to retrieve and store the manufacturer's data in our database. We receive data regarding the body measurements which are stored by Withings.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 25.11.14
 * Time: 14:58
 */

$response = $withings->getBodyMeasures();

$measuregrpsArray = $response->body->measuregrps;

//run through each date
for ($x = 0; $x < sizeof($measuregrpsArray); $x++) {

    //need to know if value is a real measurement or a goal ! There are two categories.
    // 1 = measurement; 2 = user objectives
    $category = $measuregrpsArray[$x]->category;

    //to get the unix timestamp and convert it in a real date
    $timestamp = $measuregrpsArray[$x]->date;
    $date = date("Y-m-d", $timestamp);

    // values of the day
    $valueArray = $measuregrpsArray[$x]->measures;

    //run through each value of the date
    for ($i = 0; $i < sizeof($valueArray); $i++) {

        $value = $valueArray[$i]->value;
        $measurementId = $valueArray[$i]->type;
        $unit = $valueArray[$i]->unit;

        // convert in to double
        $valueDouble = number_format(($value / (10^($unit*(-1)))),($unit*(-1)));

        // method call to convert the measurementId
        $measurement = $withings->convertMeasurementIdToMeasurementName($measurementId);

        //if category is a real measurement
        if ($category == 1) {

            // method call to insert the value in our database
            $result = $db_connection->insertValue($userId, $company, $measurement, $date, $valueDouble);

            if (!$result) {

                $successfull = false;
            }
        }
    }
}


?>