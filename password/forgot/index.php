<?php
/**
 * Created by PhpStorm.
 * User: johannesweber
 * Date: 11.12.14
 * Time: 21:32
 */

header('Content-type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../../db_connection.php';

require_once '../../mail.php';

if($_POST) {
    $email = $_POST['email'];

    $dbConnection = new DatabaseConnection();

    $dbConnection->connect();

    $search_user = "SELECT * FROM user WHERE email = '$email'";

    $dbConnection->executeStatement($search_user);

    $result = $dbConnection->getResult();

    if (mysqli_num_rows($result) > 0) {

        $verifier = mt_rand();

        $update_user_verifier = "UPDATE user
                                 SET verifier = '$verifier'
                                 WHERE email = '$email'";

        $dbConnection->executeStatement($update_user_verifier);

        $to = $email;
        $from = "weber.johanes@gmail.com";
        $from_name = "Focused Health";
        $subject = "Focused Health | Password Reset!";

        $message  = "Hello " . $email . ",\n\n";
        $message .= "please click the following link to reset your Password: \n";
        $message .= "http://141.19.142.45/~johannes/focusedhealth/password/reset/?email=$email&verifier=$verifier\n\n";
        $message .= "If you don't requested resetting your password, feel free to ignore this mail.\n\n";
        $message .= "Thank You.\n\n";
        $message .= "Best Regards,\n";
        $message .= "Your Focused Health Team";

        $mail = new Mail();

        $mail->smtpmailer($to, $from, $from_name, $subject, $message);

        echo '{"success" : 1 , "message" : "Please see your E-Mail Inbox for further Instructions."}';

    }
}
?>
