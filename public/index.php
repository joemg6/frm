<?php

if ( !file_exists("main/pathDefault.php") ) {
    return;
}

include_once "main/pathDefault.php";
include_once "main/settings.php";

$nameProfile = "nameProfile" . SUFFIX;
@session_start();
if (isset($_SESSION[$nameProfile])) {
	header("location:" . $_SESSION[$nameProfile] . "/System");
}

require "public/languages/$deflang/initForm.$deflang.php";

?>
<!DOCTYPE html>

<html lang='es'>
<head>
<link rel="shortcut icon" href="public/images/favicon.png" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $system_name . " " . $system_version; ?> - Login</title>
    <link rel="stylesheet" type="text/css" href="public/css/init.css" />
    <script type="text/javascript" src="public/js/jquery-3.3.1.min.js"></script>
<style></style>

<script>
let x = $(document);
x.ready(ini);

function ini() {
	let x = $('input[type=submit]');
	x.click(loading);
}

function loading() {
	let x = $('.submit-button');
	let y = $('.icon-load');
	x.css("display", "none");
	y.css("display", "flex");
}

function case_alert(div_alert, time) {
    $("#"+div_alert).fadeIn('slow', function() {
        setTimeout(function() {
            $("#"+div_alert).fadeOut('slow');
        }, time);
    });
}
</script>

</head>
<body>

<?php
	$err = $_GET['error']?? NULL;
    if($err == 1){
    	echo "<div id='error' class='login-auth-error' style='display:none'><p>".$cantIdent."</div>";
    	echo "<script>case_alert(\"error\", \"100000\");</script>";
    }
?>

<div id="wrapper">
	<form name="login-form" class="login-form" action="/" method="post">
		<div class="header">
			<div><img src="public/images/isotipo-m-index.png" alt="" width="64px"></div>
		</div>

		<input type="hidden" name="_method" value="_index">
        <input type="hidden" name="csrf_token" value="1">

		<div class="content">
			<input name="level_profile" type="hidden" value="0"  >
			<input name="typeProfile" type="hidden" value="user"  >
            <label>
                <input name="usern" type="text" class="input username" placeholder="<?php echo $ident; ?>" />
            </label>
            <label>
                <input name="passwd" type="password" class="input password" placeholder="<?php echo $ident2; ?>" />
            </label>
        </div>
		<div class="footer">
			<div class="submit-button" style="display: block;" ><input type="submit" name="submit" value="<?php echo $enter; ?>" /></div>
			<div class="icon-load" style="display: none; justify-content: center;">
				<div class="spinner">
				  <div class="bounce1"></div>
				  <div class="bounce2"></div>
				  <div class="bounce3"></div>
				</div>
			</div>
		</div>
	</form>
</div>

</body>
</html>
