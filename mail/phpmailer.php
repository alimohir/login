<?php
// This code uses the popular PHPMailer library
// You should download the PHPMailer library and
// add it to the project
// I am using SMTP and hope you have access to a 
// SMTP server
// Include the PHPMailer autoloader
require_once __DIR__ . '/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/phpmailer/src/SMTP.php';
require_once __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email, $code) {
    // Create a new PHPMailer instance
    // if you do not set true in the constructor
    // PHPMailer will not throw exceoption on issues
    $mail = new PHPMailer(true);

    try {
        // Enable debugging and the constants below will help you
        // get error message to the level you configure
        //SMTP::DEBUG_OFF (0): No debug output (default).
        //SMTP::DEBUG_CLIENT (1): Output messages sent by the client.
        //SMTP::DEBUG_SERVER (2): Output messages sent by the server.
        //SMTP::DEBUG_CONNECTION (3): Output connection-level messages.
        //SMTP::DEBUG_LOWLEVEL (4): Output low-level data sent/received.
        //$mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'mail.yflai.ir';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@yflai.ir';
        $mail->Password = 'R@ot8558';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set the sender and recipient
        $mail->setFrom('support@yflai.ir', 'Support');
        $mail->addAddress($email);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Credentials';
        $mail->Body = '<html><head><title>Credentials</title></head><body><h1>Hi!</h1><p>This email has been sent because you forgot your password. <br> code : ' . $code . '<br> This code will be your password. You can change it in your profile.</p></body></html>';

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        $_SESSION["errorMessage"] = 'Failed to send email. Error: ' . $mail->ErrorInfo;
        return false;
    }
}

function sendResetLink($email, $key) {
    // Create a new PHPMailer instance
    // if you do not set true in the constructor
    // PHPMailer will not throw exceoption on issues
    $mail = new PHPMailer(true);

    try {
        // Enable debugging and the constants below will help you
        // get error message to the level you configure
        //SMTP::DEBUG_OFF (0): No debug output (default).
        //SMTP::DEBUG_CLIENT (1): Output messages sent by the client.
        //SMTP::DEBUG_SERVER (2): Output messages sent by the server.
        //SMTP::DEBUG_CONNECTION (3): Output connection-level messages.
        //SMTP::DEBUG_LOWLEVEL (4): Output low-level data sent/received.
        //$mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'mail.yflai.ir';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@yflai.ir';
        $mail->Password = 'R@ot8558';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set the sender and recipient
        $mail->setFrom('support@yflai.ir', 'Support');
        $mail->addAddress($email);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Credentials';

        $output='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p><a href="localhost/login3/view/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">localhost/login3/view/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 day for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action 
        is needed, your password will not be reset. However, you may want to log into 
        your account and change your security password as someone may have guessed it.</p>';   	
        $output.='<p>Thanks,</p>';
        $output.='<p>YFLAI.ir Team</p>';
        $body = $output; 
        $subject = "Password Recovery - YFLAI.ir";
        


        $mail->Body = $body;

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        $_SESSION["errorMessage"] = 'Failed to send email. Error: ' . $mail->ErrorInfo;
        return false;
    }
}
