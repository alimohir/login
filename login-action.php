<?php

require_once __DIR__ . '/class/Member.php';
require_once __DIR__ . '/captcha/Captcha.php';

session_start();

$captcha = new Captcha();

if (! empty($_POST["login"])) {
    $userCaptcha = filter_var($_POST["captchaCode"], FILTER_SANITIZE_STRING);
    $isValidCaptcha = $captcha->validateCaptcha($userCaptcha);
    if ($isValidCaptcha) {
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

        $member = new Member();
        $isLoggedIn = $member->processLogin($username, $password);
        if (! $isLoggedIn) {
            $_SESSION["errorMessage"] = "Invalid Credentials";
        }
    } else {
        $_SESSION["errorMessage"] = "Incorrect Captcha Code";
    }
    header("Location: ./index.php");
    exit();

}
