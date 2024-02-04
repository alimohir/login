<?php
session_start();

if (isset($_GET["lang"])) {
    $lang = $_GET["lang"];
    $_SESSION["lang"] = $lang;
} else if (isset($_SESSION["lang"])) {
    $lang = $_SESSION["lang"];
} else {
    $lang = "en";    
    $_SESSION["lang"] = $lang;
}


require_once __DIR__ . '/view/include/' . $lang . '-Captions.php';

if(!empty($_SESSION["userId"])) {
    require_once __DIR__ . '/view/dashboard.php';
} else {
    require_once __DIR__ . '/view/login-form.php';
}
?>