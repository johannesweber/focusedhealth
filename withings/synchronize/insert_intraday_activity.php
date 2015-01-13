<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 05.01.15
 * Time: 13:43
 */

/*
 * We can get no response of intraday activity because an Access to this service needs special activation. To get an Access
 * you must fill out a formular from withings
 */

$response = $withings->getIntradayActivity();
print_r($response);