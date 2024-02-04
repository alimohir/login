<?php

require_once __DIR__ . '/class/Member.php';


if (isset($_POST["register"])) {
    session_start();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password1"], FILTER_SANITIZE_STRING);

    $member = new Member();
    $not_valid_username = $member->getMemberByUsername($username);
    $not_valid_email = $member->getMemberByEmail($email);
    if (! empty($not_valid_username)) {
        $_SESSION["errorMessage"] = "Sorry, This username is in use.";
    } else {
        if (! empty($not_valid_email)) {
            $_SESSION["errorMessage"] = "The Email is already registered.";
        } else  {
            $isRegistered = $member->processRegister($username, $email,  $password);
            if (! $isRegistered) {
                $_SESSION["errorMessage"] = "Something went wrong!!!";
            } else {
                $url = "index.php?lang=" . $_SESSION["lang"];
                header("Location: $url");
                exit();
            }
        }
    }
    $url = "./view/register-form.php?lang=" . $_SESSION["lang"];
    header("Location: $url");
    exit();
}
