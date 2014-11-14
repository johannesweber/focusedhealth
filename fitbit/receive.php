<?php

require 'fitbit.php';

$token =  $_POST['oauth_token'];

$secret = $_POST['oauth_token_secret'];

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($token, $secret);

$xml = $fitbit->getProfile();

print_r($xml);

?>