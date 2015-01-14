<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 13.01.15
 * Time: 11:51
 */

$db_connection = new DatabaseConnection();
$db_connection->connect();

//include File
require_once '../medisana.php';
require_once '../../db_connection.php';

error_reporting(E_ALL);
ini_set('display errors', 'On');

$userId = $_POST['userId'];
$oauth_token = $_POST['oauth_token'];
$oauth_token_secret = $_POST['oauth_token_secret'];

/*
 *List of modules needed for the url
 *      Modulename for Url              Name of Module
 *
 *      1.cardiodocks                   = Cardiodock
 *      2.glucodockglucoses             = Glucodock Glucose
 *      3.glucodockinsulins             = Glucodock Insulin
 *      4.glucodockmeals                = Glucodock Meal
 *      5.targetscales                  = Targetscale
 *      6.thermodocks                   = Thermodock
 *      7.activitydocks                 = Activitydock
 *      8.tracker/activity              = Tracker Activity
 *      9.tracker/sleep                 = Tracker Sleep
 *      10.cardiodocks/settings         = Cardiodock Settings
 *      11.glucodockglucoses/settings   = Glucodock Glucose Settings
 *      12.glucodockinsulins/settings   = Glucodock Insulin Settings
 *      13.glucodockmeals/settings      = Glucodock Meal Settings
 *      14.thermodocks/settings         = Thermodock Settings
 *      15.targetscales/settings        = Targetscale Settings
 *      16.user/settings                = User Settings
 *      17.tracker/stats                = Tracker Stats
 *      18.tracker/phase                = Tracker Phase
 */

//create new medisana php object with consumer key and consumer secret
$vitadock = new medisanaPHP();
//set the access token and secret for this request
$vitadock->setOAuthDetails($oauth_token, $oauth_token_secret);


//acquire data from the module, which is used to call the method
$json = $vitadock->getData('cardiodocks');
$json = $vitadock->getData('glucodockglucoses');
$json = $vitadock->getData('glucodockinsulins');
$json = $vitadock->getData('glucodockmeals');
$json = $vitadock->getData('targetscales');
$json = $vitadock->getData('thermodocks');
$json = $vitadock->getData('activitydocks');
$json = $vitadock->getData('tracker/activity');
$json = $vitadock->getData('tracker/sleep');
$json = $vitadock->getData('cardiodocks/settings');
$json = $vitadock->getData('glucodockglucoses/settings');
$json = $vitadock->getData('glucodockinsulins/settings');
$json = $vitadock->getData('glucodockmeals/settings');
$json = $vitadock->getData('thermodocks/settings');
$json = $vitadock->getData('targetscales/settings');
$json = $vitadock->getData('user/settings');
$json = $vitadock->getData('tracker/stats');
$json = $vitadock->getData('tracker/phase');

require_once 'insert_credentials.php';

$db_connection->close();

?>