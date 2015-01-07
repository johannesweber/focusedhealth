<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 04.01.15
 * Time: 21:58
 */

$response = $withings->getActivityMeasures();
print_r($response);

$successfull = true;

$arrayLength = $response->body;



//run through each date
for($x = 0; $x <sizeof($arrayLength); $x++ ){

}


// get all id's wich are neccessary
$measurement = 'steps';
$stepsId = $db_connection->getMeasurementId($measurement);
$measurement = 'distance';
$distanceId = $db_connection->getMeasurementId($measurement);
$measurement = 'caloriesOut';
$caloriesOutId = $db_connection->getMeasurementId($measurement);
$measurement = 'elevation';
$elevationId = $db_connection->getMeasurementId($measurement);
$measurement = 'soft';
$softId = $db_connection->getMeasurementId($measurement);
$measurement = 'moderate';
$moderateId = $db_connection->getMeasurementId($measurement);
$measurement = 'intense';
$intenseId = $db_connection->getMeasurementId($measurement);


echo "steps: " . $stepsId . "\ndistance: " . $distanceId . "\ncaloriesOut: " . $caloriesOutId . "\nelevation: " . $elevationId
    . "\nsoft: " . $softId
    . "\nmoderate: " . $moderateId
    . "\nintense: " . $intenseId . "\n";


/*

//run through each date
for ($x = 0; $x < sizeOf(arrayLength); $x++) {



    $category = $arrayLength[$x]->category;
    $timestamp = $measuregrpsArray[$x]->date;
    $date = date("Y-m-d", $timestamp);


    /*



    // values of the day
    $valueArray = $measuregrpsArray[$x]->measures;

// run through each value of the date
    for ($i = 0; $i < sizeof($valueArray); $i++) {
        //print_r($valueArray[$i]);

        echo $value = $valueArray[$i]->value;
        echo "//";
        echo $type = $valueArray[$i]->type;

        // get the measurement id from focused health
        echo "measureID: " . $measurementId = $meastypeWithings[$type];

        //$rowCount = $db_connection->checkIfValueExists($user_id, $measurementId, $company_id, $date);
        $rowCount = $db_connection->checkIfValueExists($userId, $company, $measurement, $date, $value);

        //if category is a real measurement
        if ($category == 1) {


            //measurement was not inserted for today
            if ($rowCount == 0) {

                //SQL Statement to insert data into value table
                $insert = "INSERT INTO value (user_id, measurement_id, company_id, value, date)
         VALUES ('$userId', '$measurementId', '$companyId', '$value','$date')";

                $db_connection->executeStatement($insert);

            } else {
                //update
                /*$update = "UPDATE value SET value = '$value'
                                     WHERE user_id='$userId' AND measurement_id='$measurementId' AND company_id='$companyId' AND date = '$date'";

            }
            // if category is a goal
        } else if ($category == 2) {

        } else {

        }
    }
}*/



$withings->showSynchronizeMessage($successfull);

?>