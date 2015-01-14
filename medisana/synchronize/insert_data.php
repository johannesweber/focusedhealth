<?php
/**
 * Created by PhpStorm.
 * User: timonvogler
 * Date: 14.01.15
 * Time: 17:05
 */






//#################

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


//acquire data from the module, which is used to call the method
$json = $vitadock->getData('cardiodocks');
echo($json);
$json = $vitadock->getData('glucodockglucoses');
echo($json);
$json = $vitadock->getData('glucodockinsulins');
echo($json);
$json = $vitadock->getData('glucodockmeals');
echo($json);
$json = $vitadock->getData('targetscales');
echo($json);
$json = $vitadock->getData('thermodocks');
echo($json);
$json = $vitadock->getData('activitydocks');
echo($json);
$json = $vitadock->getData('tracker/activity');
echo($json);
$json = $vitadock->getData('tracker/sleep');
echo($json);
$json = $vitadock->getData('cardiodocks/settings');
echo($json);
$json = $vitadock->getData('glucodockglucoses/settings');
echo($json);
$json = $vitadock->getData('glucodockinsulins/settings');
echo($json);
$json = $vitadock->getData('glucodockmeals/settings');
echo($json);
$json = $vitadock->getData('thermodocks/settings');
echo($json);
$json = $vitadock->getData('targetscales/settings');
echo($json);
$json = $vitadock->getData('user/settings');
echo($json);
$json = $vitadock->getData('tracker/stats');
echo($json);
$json = $vitadock->getData('tracker/phase');

