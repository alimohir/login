<?php
if(!session_id()) {
    session_start();
}

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Member.php';
    $member = new Member();
    $memberResult = $member->getMemberById($_SESSION["userId"]);
    $username = $memberResult[0]["user_name"];
} else {
    header("Location: ./index.php");
}

?>
<html>
<head>
<title>User Login</title>
<link href="./view/css/form.css" rel="stylesheet" type="text/css" />
<style>
body {
	font-family: Arial;
	color: #FFF;
	font-size: 2em;
    background: url("./view/images/welcome.webp");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
}
</style>
</head>
<body>
    <div>
        <header class="header">
            <p><a href="#" class="logout-button">Profile</a></p>
        </header>
        <div class="dashboard">
            <p><h1><?php echo $username; ?></h1></p>
        </div>
        <footer class="footer">
            <p><a href="./logout.php" class="logout-button">Logout</a></p>
        </footer>
    </div>
</body>
</html>
