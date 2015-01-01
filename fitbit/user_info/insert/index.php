<?php

$response = $fitbit->getProfile();

$error = true;

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

$select_water_goal = "SELECT * FROM company_account_info WHERE user_id='$userId' AND company_id='$companyId'";
$result = $db_connection->executeStatement($select_water_goal);
$rowCount = $result->num_rows;

if ($rowCount == 0) {

//SQL Statement to insert data into user info table
    $insert = "INSERT INTO company_account_info (user_id, company_id, company_account_id, avatar, city, country, dateOfBirth, distanceUnit, fullName, gender, glucoseUnit, height, heightUnit, locale, memberSince, waterUnit, weightUnit, timezone)
    VALUES ('$userId', '$companyId', '$encodedId', '$avatar', '$city', '$country', '$dateOfBirth', '$distanceUnit', '$fullName', '$gender', '$glucoseUnit', '$height', '$heightUnit', '$locale', '$memberSince', '$waterUnit', '$weightUnit', '$timezone')";

    $result = $db_connection->executeStatement($insert);

    if (!$result) {
        $error = false;
    }

} else {

    $update = "UPDATE company_account_info set company_account_id='$encodedId', avatar='$avatar', city='$city', country='$country', dateOfBirth='$dateOfBirth', distanceUnit='$distanceUnit',
              fullName='$fullName', gender='$gender', glucoseUnit='$glucoseUnit', height='$height', heightUnit='$heightUnit', locale='$locale', memberSince='$memberSince', waterUnit='$waterUnit', weightUnit='$weightUnit', timezone='$timezone'
              WHERE user_id='$userId'  AND company_id ='$companyId'";

    $result = $db_connection->executeStatement($update);

    if (!$result) {
        $error = false;
    }


}

?>
