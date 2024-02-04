<?php

require_once __DIR__ . '/class/Member.php';

if (! empty($_POST["code"])) {
    $code = filter_var($_POST["code"], FILTER_SANITIZE_STRING);
    if(!session_id()) {
        session_start();
    }
    $member = new Member();
    $email = $_SESSION["email"];
    $isRight = $member->checkCode($email, $code);
    if ($isRight) {
        $_SESSION["successMessage"] = "Use the CODE as your password!!!";
        header("Location: ./index.php");
        exit();
    } else {
        $_SESSION["errorMessage"] = "Wrong Code!!!";
        header("Location: ./view/fpasscode.php");
        exit();
    }
}

?>
