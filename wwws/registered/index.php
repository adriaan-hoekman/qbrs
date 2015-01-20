<?php

	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';

	date_default_timezone_set("America/Toronto");

	$netid = $_SERVER['HTTP_QUEENSU_NETID'];
	$name = $_SERVER['HTTP_COMMON_NAME'];
	$email = $_SERVER['HTTP_QUEENSU_MAIL'];
	$da = date("Y-m-d H:i:s");
	
	if (is_registered($dbc, $netid) == 0) {
		register_user($dbc, $netid, $name, $email, $da);
	}

	if (is_admin($dbc, $netid) == 0) {
		header('Location: ./home.php');
	} else {
		header('Location: ./admin.php');
	}
?>
