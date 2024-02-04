<? php 
	require_once __DIR__ . '/../class\Member.php';	
	if(!session_id()) {
		session_start();
	}
	echo "reset password entered.";
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reset Password</title>
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
	    <h1>body entered</h1>
	<?php
	    echo "reset password entered.";
		if (isset($_SESSION["errorMessage"])) {
			echo "<div class=\"error-message\"> \n";
			echo $_SESSION["errorMessage"]; 
			echo "</div> \n";
			unset($_SESSION["errorMessage"]);
		}
		if (isset($_SESSION["successMessage"])) {
			echo "<div class=\"success-message\"> \n";
			echo $_SESSION["success-message"]; 
			echo "</div> \n";
			unset($_SESSION["success-message"]);
		}
		require_once __DIR__ . '../class/Member.php';	
		
		if (isset($_GET["key"]) && isset($_GET["email"]) 
		&& isset($_GET["action"]) && ($_GET["action"]=="reset") 
		&& !isset($_POST["resetpassword"])) {
			$key = $_GET["key"];
			$email = $_GET["email"];
			$curDate = date("Y-m-d H:i:s");
			$member = new Member();
			$isReset = $member->checkKey($email, $key);
			echo "isReset : " . $isReset . "<br>";
			if (!$isReset) {
				$error = '<h2>Invalid Link</h2>
				<p>The link is invalid/expired. Either you did not copy the correct link from the email, 
				or you	 have already used the key in which case it is deactivated.</p>
				<p><a href="./reset-password.php">Click here</a> to reset password.</p>';
				echo $error;	
				$_SESSION["errorMessage"] = $error;
			}else {
				$row = $member->getKey($email);
				$expDate = $row[0]['expDate'];
				if ($expDate >= $curDate){
	?>
					<form action="../reset-password-action.php" method="post" id="frmResetPassword" onSubmit="return validate();">
						<div class="form-container">
							<div class="form-head">Enter New Password:</div>
							<div class="field-column">
								<div>
									<label for="password">Password</label>
									<span id="password1_info" class="error-info"></span>
								</div>
								<div>
									<input name="password1" id="password1" type="password" class="input-box" placeholder="Enter Password" required>
								</div>
							</div>
							<div class="field-column">
								<div>
									<label for="password2">Confirm Password</label>
									<span id="password2_info" class="error-info"></span>
								</div>
								<div>
									<input name="password2" id="password2" type="password" class="input-box" placeholder="Re-enter Password" required>
								</div>
							</div>
							<div class=field-column>
								<div>
									<input type="hidden" name="email" value="<?php echo $email;?>"/>
									<input type="submit" name="resetpassword" value="Reset Password" class="btnRegister">
								</div>
							</div>
						</div>
					</form>
				</div>
				<?php
					}else{
						$error = "<h2>Link Expired</h2>
						<p>The link is expired. You are trying to use the expired link which was valid only 24 hours (1 day after request).<br /><br /></p>";
						$_SESSION["errorMessage"] = $error;
					}
				}
			} 
				?>
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
    </script>
</body>
</html>
