<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 11.12.14
 * Time: 21:51
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

require_once '../../library/Mobile_Detect.php';

?>

<!DOCTYPE html>
<html class="changePassword" lang="en">
<head>
    <meta charset="utf-8">
    <title>Focused Health | Change Password</title>
    <meta name="description" content="">

    <script language="JavaScript" type="text/javascript" src="../../library/jquery-2.1.1.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../library/Validator/jquery.validate.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../library/Validator/additional-methods.js"></script>

    <script language="JavaScript" type="text/javascript" src="validate_user_data.js"></script>

</head>
<body class="index" id="menu">
<div class="wrap">
    <main role="main">
        <?php
        if($_GET) {
            if ($_GET['email'] && $_GET['verifier']) {

                $email = $_GET['email'];
                $verifier = $_GET['verifier'];

                $dbConnection = new DatabaseConnection();

                $dbConnection->connect();

                $select_user = "SELECT email, verifier
                        FROM user
                        WHERE email = '$email ' AND verifier = '$verifier'";

                $dbConnection->executeStatement($select_user);

                $result = $dbConnection->getResultAsArray();

                if ($email == $result['email'] && $verifier == $result['verifier']) {

                    $detect = new Mobile_Detect;

                    if (($detect->isMobile()) || ($detect->isTablet())){
                        //TODO How to delete the stored verifier after a spefific timeframe
                        header('Content-type: application/json');
                        echo '{"success" : 1}';
                        header('Location: oauth-callback://oauth-callback/password/forgot');
                        exit();

                    }else {
                        header('Content-type: text/html');
        ?>
        <h3>Change Password</h3>
        <section id="content">
            <div>
                Please type in your E-Mail Adress and your new Password.<br>
                After you changed your Password you can go back to Focused Health App<br>
                and to Login and use your Focused Health Account again<br><br>

            </div>
            <form class="form" action="../change/index.php" method="post">
                <div>
                    <label for="email">E-Mail Address:</label><span class="required">*</span>
                    <input type="text" id="email" name="email" size="20">
                </div>
                <div>
                    <label for="password">New Password:</label><span class="required">*</span>
                    <input type="password" id="password" name="password" size="20">
                </div>
                <div>
                    <label for="password">Confirm New Password:</label><span class="required">*</span>
                    <input type="password" id="confirmPassword" name="confirmPassword" size="20">
                </div>
                <input class="submit" type="submit" value="Change Password">
            </form>
        </section>
        <?php
                        //TODO what do i need here
                    }
                } else {

                    echo '{"success" : 0, "message" : "You are looking for the wrong User!"}';
                }
            } else {

                echo '{"success" : 0, "message" : "Invalid Data!"}';
            }

        }else {
            echo '{"success" : 0, "message" : "No Data available!"}';
        }
        ?>
    </main>
</div>
</body>
</html>
