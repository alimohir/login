<?php

require_once __DIR__ . '/class/Member.php';

require_once __DIR__ . '/mail/phpmailer.php';

if(!session_id()) {
    session_start();
}

if (! empty($_POST["email"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $member = new Member();
    $isMember = $member->getMemberByEmail($email);
    if (empty($isMember)) {
        $_SESSION["errorMessage"] = "Email is not registered.";
        header("Location: ./view/fpass.php");
        exit();
    }else {
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $key = password_hash($email, PASSWORD_BCRYPT);
    
        if (sendResetLink($email, $key)) {
            // $_SESSION["email"] = $email;
            $member->saveKey($email, $key, $expDate);
            $_SESSION["successMessage"] = "Reset password link sent to your Email successfully.";
            header("Location: ./index.php");
            exit();
        } else {
            $_SESSION["errorMessage"] = "EMail did not sent.";
            header("Location: ./view/fpass.php");
            exit();
        }
    }
}

?>