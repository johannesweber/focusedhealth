<?php

require '../receive_token/index.php';

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

//SQL Statement to insert data into user table
$sql = "INSERT INTO fitbit_user_info (fh_user_id, fitbit_user_id, avatar, city, country, dateOfBirth, encodedId, distanceUnit, gender, glucoseUnit, height, heightUnit, locale, memberSince, waterUnit, weightUnit, timezone)
        VALUES ('42', NULL, '$avatar', '$city', '$country', '$dateOfBirth', '$encodedId', '$distanceUnit', '$gender', '$glucoseUnit', '$height', '$heightUnit', '$locale', '$memberSince', '$waterUnit', '$weightUnit', '$timezone')";

// execute
$db_result = mysqli_query( $db_connection, $sql );
if ( ! $db_result )
{
    die('Ungültige Abfrage: '. mysqli_error($db_connection));
} else {
    echo "hat funktioniert";
}

mysqli_free_result( $db_result );
mysqli_close($db_connection);
exit();
?>

/**


 *
**/
