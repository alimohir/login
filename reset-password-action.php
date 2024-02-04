<?php

require_once __DIR__ . '/class/Member.php';

if (! empty($_POST["password1"])) {
    $password = filter_var($_POST["password1"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!session_id()) {
        session_start();
    }
    $member = new Member();
    $member->updatePassword($email, $password);
    $_SESSION["successMessage"] = "Password updated!!!";
    header("Location: ./index.php");
    exit();
}

?>
