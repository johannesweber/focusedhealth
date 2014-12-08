<?php
/**
 * Created by PhpStorm.
 * User: pauer
 * Date: 03.12.14
 * Time: 13:52
 */

$userId = '42';

include '../../id/find_water_id.php';


$fetch = "SELECT value, date, waterUnit
        FROM value
        JOIN company_account_info AS cai on value.user_id = cai.user_id
        WHERE value.user_id='$userId' AND value.measurement_id = '$waterId'
        ORDER BY date DESC
        LIMIT 7";

$db_connection->executeStatement($fetch);
$result = $db_connection->getResultAsJSON();

echo $result;

?>





