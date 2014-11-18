<?php

require_once '../fitbitphp.php';

require_once '../fetch_credentials.php';

require_once '../db_connection.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

$response = $fitbit->getProfile();

$avatar = $response->user->avatar;
$city = $response->user->city;
$country = $response->user->country;
$dateOfBirth = $response->user->dateOfBirth;
$encodedId = $response->user->encodedId;
$distanceUnit = $response->user->distanceUnit;
$fullName = $response->user->fullName;
$gender = $response->user->gender;
$glucoseUnit = $response->user->glucoseUnit;
$height = $response->user->height;
$heightUnit = $response->user->heightUnit;
$locale = $response->user->locale;
$memberSince = date("Y-m-d", strtotime($response->user->memberSince));
$timezone = $response->user->timezone;
$waterUnit = $response->user->waterUnit;
$weightUnit = $response->user->weightUnit;

//SQL Statement to insert data into user info table
$sql = "INSERT INTO fitbit_user_info (fh_user_id, fitbit_user_id, avatar, city, country, dateOfBirth, encodedId,distanceUnit, gender, glucoseUnit, height, heightUnit, locale, memberSince, waterUnit, weightUnit, timezone)
        VALUES ('42', NULL, '$avatar', '$city', '$country', '$dateOfBirth', '$encodedId', '$distanceUnit', '$gender', '$glucoseUnit', '$height', '$heightUnit', '$locale', '$memberSince', '$waterUnit', '$weightUnit', '$timezone')";

require '../execute_statement.php';

?>