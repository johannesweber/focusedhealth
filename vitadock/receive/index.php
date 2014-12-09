<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 16.11.14
 * Time: 13:32
 */

require '../oauthvitadock/oauthvitadock.php';


//create new vitadock php objekt with consumer key and consumer secret
$vitadock = new VitadockPHP(
    "qpvX7zc7Rb3AwaDB5jTrluh5Z2b7FS9fCMcEgn7GFYA7DtP71WPvs1f8mkprsLEe",
    "RrjgTMKmzUP59uXZyB0ZAK57g0UDUMy9oCWzWFuDnKrN5PDCSx8N5GYe0S63PXUm"
);
//vitadock oauth flow starts and redirecting to callback url
$vitadock->initSession("http://141.19.142.45/~johannes/focusedhealth/vitadock/receive/");

print_r($vitadock);

?>