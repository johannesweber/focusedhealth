<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 16.11.14
 * Time: 13:32
 */

require '../oauthwithings/withingsphp.php';


//create new withings php objekt with consumer key and consumer secret
$withings = new WithingsPHP(
    "0b1de1b1e2473372f5e8e30d0f13e38f9b20c84320cf8243517e73c0c084",
    "cdb631b4102893076d6feb038fd5fe7fd28431b998881d5c001307cece802"
);
//withings oauth flow start
$withings->initSession("http://141.19.142.45/~johannes/focusedhealth/withings/receive/");



?>