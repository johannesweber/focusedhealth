<?php
/**
 *
 * This Class is used to retrieve and store the manufacturer's data in our database.
 *
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 13:44
 */


$response = $withings->getSleepMeasure('1420588800', '1420588800');
print_r($response);



