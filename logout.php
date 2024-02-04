<?php 
session_start();
$_SESSION["user_id"] = "";
session_destroy();
$url = "index.php?lang=" . $_SESSION["lang"];
header("Location: $url");
exit();
