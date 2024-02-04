<?php 
	if (!session_id()) {
		session_start();
	}
	// echo "<br><pre>";
	// var_dump ($_SESSION);
	// echo "</pre><br>";

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
	<title><?php echo $Language["register-form-title"];?></title>
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
		<form action="../register-action.php" method="post" id="frmRegister" onSubmit="return validate();">
			<div class=<?php echo $lang . "-form-container"; ?>>
				<div class="language-link" onClick=<?php $_SESSION["lang"] = ($lang == "en") ?  "fa" : "en"; ?>>
					<a href=<?php echo "register-form.php?lang=" . $_SESSION["lang"] ?>>
							<?php echo $langName;?>
					</a>
				</div>	
				<div class="form-head"><?php echo $Language["register-form-header"];?></div>
				<?php require_once __DIR__ . '/include/showMessage.php'; ?>
                <div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="username"><?php echo $Language["Username"];?></label>
						<span id="user_info" class="error-info"></span>
					</div>
					<div>
						<input name="username" id="username" type="text" class=<?php echo $lang . "-input-box";?> 
							placeholder=<?php echo "\"" . $Language["Select_a_Username"] . "\"";?> required>
					</div>
				</div>
                <div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="email"><?php echo $Language["Email"];?></label>
						<span id="email_info" class="error-info"></span>
					</div>
					<div>
						<input name="email" id="email" type="email" class=<?php echo $lang . "-input-box";?> 
							placeholder=<?php echo "\"" . $Language["Enter_your_Email_address"] . "\"";?> required>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="password1"><?php echo $Language["Password"];?></label>
						<span id="password1_info" class="error-info"></span>
					</div>
					<div style="text-align: <?php if ($lang == "en") {echo "right";} else {echo "left";}?>">
						<input name="password1" id="password1" type="password" class=<?php echo $lang . "-input-box";?> 
							placeholder=<?php echo "\"" . $Language["Enter_Password"] . "\"";?> required>
							<i class="password-toggle-icon"><img src="./images/eye-fill.svg" 
								id="togglePassword" onclick="javascript:togglePasswordShow()">
							</i>
						</input>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="password2"><?php echo $Language["Confirm_Password"];?></label>
						<span id="password2_info" class="error-info"></span>
					</div>
					<div style="text-align:  <?php if ($lang == "en") {echo "right";} else {echo "left";}?>">
						<input name="password2" id="password2" type="password" class=<?php echo $lang . "-input-box";?> 
							placeholder=<?php echo "\"" . $Language["Re-enter_Password"] . "\"";?> required>
							<i class="password-toggle-icon"><img src="./images/eye-fill.svg" 
								id="toggleConfirmPassword" onclick="javascript:toggleConfirmPasswordShow()">
							</i>
						</input>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<input type="submit" name="register" value=<?php echo $Language["register-form-header"];?> class="btnRegister">
					</div>
				</div>
				<div class="login-row form-nav-row">
					<p><?php echo $Language["Already_user?"];?></p>
					<a href="../index.php?lang=<?php echo $lang; ?>" class="btnLogin"><?php echo $Language["Log_in"];?></a>
				</div>
			</div>
		</form>
	</div>
	<script>
    function validate() {
        var $valid = true;
        var password1 = document.getElementById("password1").value;
        var password2 = document.getElementById("password2").value;
        if(password1 != password2) {
			document.getElementById("password2_info").innerHTML = "Does not match";
            $valid = false;
        }
        return $valid;
	}
	function togglePasswordShow() {
			var passwordImg = document.getElementById("togglePassword");
			var passwordInput = document.getElementById("password1");
			var imgPath = passwordImg.src;
			var imgFilename = imgPath.split("/").pop();;
			if (imgFilename == "eye-fill.svg") {
				passwordImg.src = "./images/eye-slash-fill.svg";
				passwordInput.type = "text";
			} else {
				passwordImg.src = "./images/eye-fill.svg";
				passwordInput.type = "password";
			}
		}

		function toggleConfirmPasswordShow() {
			var passwordImg = document.getElementById("toggleConfirmPassword");
			var passwordInput = document.getElementById("password2");
			var imgPath = passwordImg.src;
			var imgFilename = imgPath.split("/").pop();;
			if (imgFilename == "eye-fill.svg") {
				passwordImg.src = "./images/eye-slash-fill.svg";
				passwordInput.type = "text";
			} else {
				passwordImg.src = "./images/eye-fill.svg";
				passwordInput.type = "password";
			}
		}

	</script>
</body>
</html>
