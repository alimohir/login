<?php
	if(!session_id()) {
		session_start();
	}

	$lang = $_SESSION["lang"];
	$langName = "فارسی";
	if ($lang == "fa") {
    	$langName = "English";
	} 

	require_once __DIR__ . '/include/header.php';
	

?>

<body>
	<div>
		<form action="./login-action.php" method="post" id="frmLogin">
			<div class=<?php echo $lang . "-form-container"; ?>>
				<div class="language-link" onClick=<?php $_SESSION["lang"] = ($lang == "en") ?  "fa" : "en"; ?>>
					<a href=<?php echo "index.php?lang=" . $_SESSION["lang"];?>>
						<?php echo $langName;?>
					</a>
				</div>	
				<div class="form-head"><?php echo $Language["login-form-header"];?></div>
				<?php require_once __DIR__ . '/include/showMessage.php'; ?>
                <div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="username"><?php echo $Language["Username"];?></label>
						<span id="user_info" class="error-info"></span>
					</div>
					<div>
						<input name="username" id="username" type="text" class=<?php echo $lang . "-input-box";?> 
							placeholder=<?php echo "\"" . $Language["Enter_Username_or_Email"] . "\"";?> required>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<label for="password"><?php echo $Language["Password"];?></label>
						<span id="password_info" class="error-info"></span>
					</div>
					<div style="text-align:  <?php if ($lang == "en") {echo "right";} else {echo "left";}?>">
						<input name="password" id="password" type="password" class=<?php echo $lang . "-input-box";?> 
							placeholder=<?php echo "\"" . $Language["Enter_Password"] . "\"";?> required>
							<i class=<?php echo $lang . "-password-toggle-icon";?>><img src="./view/images/eye-fill.svg" 
								id="togglePassword" onclick="javascript:togglePasswordShow()">
							</i>
						</input>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<img src="./captcha/captchaImageSource.php" id="captcha" class="captcha-img" onclick="javascript:reloadCaptcha();">
						<input type="text" name="captchaCode"  class="captcha-input" required>
					</div>
				</div>
				<div class=<?php echo $lang . "-field-column"; ?>>
					<div>
						<input type="submit" name="login" value=<?php echo $Language["Login"];?> class="btnLogin">
					</div>
				</div>
				<div class="form-nav-row">
					<a href="./view/fpass.php?lang=<?php echo $lang; ?>" class="form-link"><?php echo $Language["Forgot_password?"];?></a>
				</div>
				<div class="login-row form-nav-row">
					<p><?php echo $Language["New_user?"]; ?></p>
					<a href="./view/register-form.php?lang=<?php echo $lang; ?>" class="btnRegister"><?php echo $Language["Register_Now"]; ?></a>
				</div>
				<div class="login-row form-nav-row">
					<p><?php echo $Language["May_also_signup_with"]; ?></p>
					<a href="#"><img src="./view/images/icon-facebook.png" class="signup-icon" /></a>
					<a href="#"><img src="./view/images/icon-twitter.png" class="signup-icon" /></a>
					<a href="#"><img src="./view/images/icon-linkedin.png" class="signup-icon" /></a>
				</div>
			</div>
		</form>
	</div>
	<script>
		function reloadCaptcha() {
			var captchaImg = document.getElementById("captcha");
			captchaImg.src = '../captcha/captchaImageSource.php';
			return true;
		}

		function togglePasswordShow() {
			var passwordImg = document.getElementById("togglePassword");
			var passwordInput = document.getElementById("password");
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
