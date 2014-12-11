<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 20.11.14
 * Time: 17:57
 */

include 'withingsphp.php';

$oauth_token = $_GET['oauth_token'];
$oauth_token_secret = $_GET['oauth_token_secret'];
$userid = $_GET['userid'];

$withings = new WithingsPHP();

$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $userid);

$withings->getBodyMeasures();

?>