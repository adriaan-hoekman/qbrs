<? php
	
	include_once './lib/global.conf.php';

	if($dbc)
	{	
		echo "Successful connected to Your MySQL!~ Good Job QBRS~";
	}
	else {
		echo "Your connection failed~ Please check the setting~!";
	}
	mysql_close();

?>