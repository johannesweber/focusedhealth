<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 20.11.14
 * Time: 17:57
 */

include 'withingsphp.php';

$oauth_consumer_key = $_GET['oauth_consumer_key'];
$oauth_token = $_GET['oauth_token'];
$oauth_signature_method = $_GET['oauth_signature_method'];
$oauth_signature = $_GET['oauth_signature'];
$oauth_version = $_GET['oauth_version'];
$oauth_timestamp = $_GET['oauth_timestamp'];
$userid = $_GET['userid'];
$oauth_nonce = $_GET['oauth_nonce'];
$action = $_GET['action'];

$withings = new WithingsPHP();

$withings->setOAuthDetails($oauth_consumer_key, $oauth_token, $oauth_signature_method, $oauth_signature, $oauth_version, $oauth_timestamp, $userid, $oauth_nonce);

$withings->sendRequestToWithings($action);

?>