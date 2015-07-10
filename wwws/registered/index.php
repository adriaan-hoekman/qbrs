<?php
/*
|--------------------------------------------------------------------------
| Registered Folder Redirect Index
|--------------------------------------------------------------------------
|
| Index page after SSO.
| Check if the user is registered, if not, register for them.
| Check if the user is Admin, Cyclist. Regirect to correct page.
|
*/

    // Include function/config file for feature uses.
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';

	date_default_timezone_set("America/Toronto");

	$netid = $_SERVER['HTTP_QUEENSU_NETID'];
	$name = $_SERVER['HTTP_COMMON_NAME'];
	$email = $_SERVER['HTTP_QUEENSU_MAIL'];
	$da = date("Y-m-d H:i:s");
	
	// Check if user is registered.
	if (is_registered($dbc, $netid) == 0) {
		register_user($dbc, $netid, $name, $email, $da);
	}

	// Check if user is admin, and regirect.
	if (is_admin($dbc, $netid) == 0) {
		header('Location: ./home.php');
	} else {
		header('Location: ./admin.php');
	}
?>
