<?php

	//$link = mysqli_connect(Null,'test','testqbrs','qbrs','4444','/home/users/qbrssec/www-data/tmp/mysql.sock');
	include_once '../lib/global.conf.php';

	if($dbc)
	{
		echo "Successful connected to Your MySQL!~ Good Job QBRS~" . mysqli_get_host_info($link) . "\n";
	}
	else {
		echo "Your connection failed~ Please check the setting~!\n";
		die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
	}

	mysqli_close($dbc);

?>
