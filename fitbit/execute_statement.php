<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 20:12
 */

$db_result = mysqli_query( $db_connection, $sql );

if ( ! $db_result )
{
    die('Ungültige Abfrage: '. mysqli_error($db_connection));
} else {
    echo "hat funktioniert";
}

?>