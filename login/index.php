<?php

header('Content-type: application/json');

if($_POST) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if($username && $password) {

        $db_name     = 'healthhub';
        $db_user     = '5ive';
        $db_password = 'team5ivemysql';
        $server_url  = 'localhost';

        $mysqli = new mysqli('localhost', $db_user, $db_password, $db_name);

        /* check connection */
        if (mysqli_connect_errno()) {
            error_log("Connect failed: " . mysqli_connect_error());
            echo '{"success":0,"error_message":"' . mysqli_connect_error() . '"}';
        } else {
            if ($stmt = $mysqli->prepare("SELECT username FROM user WHERE username = ? and password = ?")) {

                /* bind parameters for markers */
                $stmt->bind_param("ss", $username, md5($password));

                /* execute query */
                $stmt->execute();

                /* bind result variables */
                $stmt->bind_result($id);

                /* fetch value */
                $stmt->fetch();

                /* close statement */
                $stmt->close();
            }

            /* close connection */
            $mysqli->close();

            if ($id) {
                error_log("User $username: password match.");
                echo '{"success":1}';
            } else {
                error_log("User $username: password doesn't match.");
                echo '{"success":0,"error_message":"Invalid Username/Password"}';
            }
        }
    } else {
        echo '{"success":0,"error_message":"Invalid Username/Password."}';
    }
}else {
    echo '{"success":0,"error_message":"Invalid Data."}';
}
?>