<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 20.11.14
 * Time: 17:57
 */

require_once 'withingsphp.php';

// to use in the future
/*$oauth_token = $_GET['oauth_token'];
$oauth_token_secret = $_GET['oauth_token_secret'];
$userid = $_GET['userid'];
*/


$oauth_token = '7c144c3075d37c657e7f4079cf6e508517d7626c2e6c8e384065429';
$oauth_token_secret = '779e3cbfb2d220e4fd236fcbb75269f28394fcfc3617f66e5f5bcf27e7e';
$userid = '5064852';

$withings = new WithingsPHP();

$withings->setOAuthDetails($oauth_token, $oauth_token_secret, $userid);

$withings->getBodyMeasures();

?>