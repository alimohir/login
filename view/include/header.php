<!DOCTYPE html>
<?php
if ($lang == 'en') {
    echo "<html dir=\"ltr\" lang=\"en\">";
} else if ($lang == 'fa')  {
    echo "<html dir=\"rtl\" lang=\"fa\">";
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $Language["login-form-title"];?></title>
<link href="./view/css/form.css" rel="stylesheet" type="text/css" />
<link href="./view/css/language.css" rel="stylesheet" type="text/css" />
<style>
body {
	font-family: Arial;
	color: #333;
	font-size: 0.95em;
	background-image: url("./view/images/bg.jpeg");
}
</style>
</head>
