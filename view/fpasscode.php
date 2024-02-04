<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forgot Password</title>
<link href="./css/form.css" rel="stylesheet" type="text/css" />
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
		<form action="../fpasscode-action.php" method="post" id="frmFPassCode">
			<div class="form-container">
				<div class="form-head">Enter Code</div>
				<?php
					if(!session_id()) {
						session_start();
					}
					if (isset($_SESSION["errorMessage"])) {
		                echo "<div class=\"error-message\"> \n";
						echo $_SESSION["errorMessage"]; 
						echo "</div> \n";
	                    unset($_SESSION["errorMessage"]);
					}

					if (isset($_SESSION["successMessage"])) {
		                echo "<div class=\"success-message\"> \n";
						echo $_SESSION["successMessage"]; 
						echo "</div> \n";
	                    unset($_SESSION["successMessage"]);
					}
                ?>
                <div class="field-column">
					<div>
						<label for="code">Verification Code</label>
						<span id="code_info" class="error-info"></span>
					</div>
					<div>
						<input name="code" id="code" type="text" class="input-box" placeholder="Enter code sent to your Email" required>
					</div>
				</div>
				<div class=field-column>
					<div>
						<input type="submit" name="setPassword" value="Set Password" class="btnLogin">
					</div>
				</div>
				<br>
				<div class="login-row form-nav-row">
					<p>New user?</p>
					<a href="./register-form.php" class="btn form-link">Register Now</a>
				</div>
				<div class="login-row form-nav-row">
					<p>May also signup with</p>
					<a href="#"><img src="./images/icon-facebook.png" class="signup-icon" /></a>
					<a href="#"><img src="./images/icon-twitter.png" class="signup-icon" /></a>
					<a href="#"><img src="./images/icon-linkedin.png" class="signup-icon" /></a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
