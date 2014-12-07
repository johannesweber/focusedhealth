<?php

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
$insert_company_account_info = "INSERT INTO company_account_info (company_account_id, avatar, city, country, dateOfBirth, distanceUnit, fullName, gender, glucoseUnit, height, heightUnit, locale, memberSince, waterUnit, weightUnit, timezone)
    VALUES ('$encodedId', '$avatar', '$city', '$country', '$dateOfBirth', '$distanceUnit', '$fullName', '$gender', '$glucoseUnit', '$height', '$heightUnit', '$locale', '$memberSince', '$waterUnit', '$weightUnit', '$timezone')";

$db_connection->executeStatement($insert_company_account_info);

?>
