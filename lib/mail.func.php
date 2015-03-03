<?php
function missing_send_mail($to, $name){
	$subject = "This is Your Missing Report";

	$message = "
	<html>
	<head>
	<title>This is Your Missing Report</title>
	</head>
	<body>
	<p>Hi David</p>
	<p>The Following information is your missing report. Please keep on file for furture uses.</p>
	</body>
	</html>
	";

	// always set content-type for HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// More Header
	$headers .= 'From: Bicycle Registration System<Do-Not-Reply@Queensu.ca>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
} 

function found_send_mail($to, $name){
	$subject = "Your bicycle has been found";

	$message = "
	<html>
	<head>
	<title>Your Bicycle has been found</title>
	</head>
	<body>
	<p>Hi David</p>
	<p>The Following information is your missing report. Please keep on file for furture uses.</p>
	</body>
	</html>
	";

	// always set content-type for HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// More Header
	$headers .= 'From: Bicycle Registration System<Do-Not-Reply@Queensu.ca>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

}


?>