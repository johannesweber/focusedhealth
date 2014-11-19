<?php

include_once '../fitbitphp.php';

include_once '../db_connection.php';

include_once '../fetch_credentials.php';

$fitbit = new FitBitPHP("7c39abf127964bc984aba4020845ff11", "18c4a92f21f1458e8ac9798567d3d38c");
$fitbit->setOAuthDetails($oauth_token, $oauth_token_secret);
$fitbit->setResponseFormat('json');

$response = $fitbit->getProfile();

$avatar = $response->user->avatar;
$city = $response->user->city;
$country = $response->user->country;
$dateOfBirth = $response->user->dateOfBirth;
$encodedId = $response->user->user_company_account_id;
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
$insert_user_info = "INSERT INTO company_account_info (fh_user_id, id, avatar, city, country, dateOfBirth, user_company_account_id, distanceUnit, gender, glucoseUnit, height, heightUnit, locale, memberSince, waterUnit, weightUnit, timezone)
        VALUES ('42', NULL, '$avatar', '$city', '$country', '$dateOfBirth', '$encodedId', '$distanceUnit', '$gender', '$glucoseUnit', '$height', '$heightUnit', '$locale', '$memberSince', '$waterUnit', '$weightUnit', '$timezone')";

$result_user_info = mysqli_query( $db_connection, $insert_user_info );

if ( ! $result_user_info )
{
    die('Ungültige Abfrage: '. mysqli_error($db_connection));
} else {
    echo "hat funktioniert";
}

mysqli_free_result($result_user_info);

?>