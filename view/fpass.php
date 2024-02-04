<?php 
	if (!session_id()) {
		session_start();
	}
	if (isset($_GET["lang"])) {
		$lang = $_GET["lang"];
		$_SESSION["lang"] = $lang;
	} else if (isset($_SESSION["lang"])) {
		$lang = $_SESSION["lang"];
	} else {
		$lang = "en";    
		$_SESSION["lang"] = $lang;
	}
	
	$langName = "فارسی";
	if ($lang == "fa") {
    	$langName = "English";
	} 
	require_once __DIR__ . '/include/' . $lang . '-Captions.php';
?>

<!DOCTYPE HTML>
<?php
if ($lang == 'en') {
    echo "<html dir=\"ltr\" lang=\"en\">";
} else if ($lang == 'fa')  {
    echo "<html dir=\"rtl\" lang=\"fa\">";
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $Language["Forgot_Password"];?></title>
<link href="./css/form.css" rel="stylesheet" type="text/css" />
<link href="./css/language.css" rel="stylesheet" type="text/css" />
<style>
body {
	font-family: Arial;
	color: #333;
	font-size: 0.95em;
	background-image: url("./images/bg.jpeg");
}
</style>
</head>
<body>
	<div>
		<form action="../fpass-action.php" method="post" id="frmFPass">
			<div class=<?php echo $lang . "-form-container"; ?>>
				<div class="language-link" onClick=<?php $_SESSION["lang"] = ($lang == "en") ?  "fa" : "en"; ?>>
					<a href=<?php echo "fpass.php?lang=" . $_SESSION["lang"];?>>
						<?php echo $langName;?>
					</a>
				</div>	
				<div class="form-head" style="padding: 0 10% 0 0;"><?php echo $Language["Forgot_Your_Pasword?"];?></div>
				<?php require_once __DIR__ . '/include/showMessage.php'; ?>
                <div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="email"><?php echo $Language["Registered_Email"];?></label>
						<span id="email_info" class="error-info"></span>
					</div>
					<div>
						<input name="email" id="email" type="email" class=<?php echo $lang . "-input-box";?> placeholder=<?php echo $Language["Enter_your_registered_Email"];?> required>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<input type="submit" name="fpass" value=<?php echo $Language["Send_Email"];?> class="btnLogin">
					</div>
				</div>
				<br>
				<div class="login-row form-nav-row">
					<p><?php echo $Language["New_user?"];?></p>
					<a href="./register-form.php?lang=<?php echo $lang; ?>" class="btnRegister"><?php echo $Language["Register_Now"];?></a>
				</div>
				<div class="login-row form-nav-row">
					<p><?php echo $Language["May_also_signup_with"]; ?></p>
					<a href="#"><img src="./images/icon-facebook.png" class="signup-icon" /></a>
					<a href="#"><img src="./images/icon-twitter.png" class="signup-icon" /></a>
					<a href="#"><img src="./images/icon-linkedin.png" class="signup-icon" /></a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
