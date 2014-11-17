<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 17.11.14
 * Time: 10:30
 */

define ("MYSQL_HOST", "localhost");
define ("MYSQL_USER", "5ive");
define ("MYSQL_PASSWORD", "team5ivemysql");
define ( "MYSQL_DATABASE", "healthhub" );
$db_connection = mysqli_connect (MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASSWORD,
    MYSQL_DATABASE
);
if ( ! $db_connection ){
    echo 'failed';
}
?>