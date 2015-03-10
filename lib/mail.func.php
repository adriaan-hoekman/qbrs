<?php

function missing_send_mail($to, $name, $bicycleserial, $bicyclemake, $bicyclemodel, $bicycledesc, $datemissing, $timemissing, $missinglocation, $missingdetail){

	$parkingphone = $_SERVER['parkingphone'];
	$parkingemail = $_SERVER['parkingemail'];
	$securityphone = $_SERVER['securityphone'];
	$securityemail = $_SERVER['securityemail'];
	$kingstonpolicephone = $_SERVER['kingstonpolicephone'];
	$kingstonpoliceemail = $_SERVER['kingstonpoliceemail'];

	$subject = "This is Your Missing Report";

	$message = "
	<html>
	<head>
	<title>This is Your Missing Report</title>
	</head>
	<body>
	<p>Hello ".$name."</p>
	<p>The following is the information detailed in the missing report for your bicycle. Please keep it on file for future use.</p>
	<br/>
	<p>You have reported the following bicycle as missing.</p>
	<p><b>Bicycle Serial Number: </b>".$bicycleserial."</p>
	<p><b>Bicycle Make: </b>".$bicyclemake."</p>
	<p><b>Bicycle Model: </b>".$bicyclemodel."</p>
	<p><b>Other Information: </b>".$bicycledesc."</p>
	<br/>
	<p>The following information is the missing report's details.</p>
	<p><b>Date Missing: </b>".$datemissing."</p>
	<p><b>Time Missing: </b>".$timemissing."</p>
	<p><b>Location Missing: </b>".$missinglocation."</p>
	<p><b>Other Information: </b>".$missingdetail."</p>
	<br/>
	<p>You may find the following contact information useful.</p>
	<p>Campus Security. Phone: ".$securityphone." E-mail: ".$securityemail."</p>
  <p>Campus Parking. Phone: ".$parkingphone." E-mail: ".$parkingemail."</p>
  <p>Kingston Police. Phone: ".$kingstonpolicephone." E-mail: ".$kingstonpoliceemail."</p>
	</body>
	</html>
	";

	// always set content-type for HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// More Header
	$headers .= 'From: Queens Bicycle Registration System<Do-Not-Reply@Queensu.ca>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

		// The following 4 lines of code are for testing the email function on localhost.
	// Comment them out when moving to the PROD server.
	// ------------------------------------------------------------
	echo $to;
	echo $subject;
	echo $message;
	echo $headers;
	return false;
	// -----------------------------------------------------------
	// The following 2 lins of code are MUST be uncommented when this code runs on the PROD server.
	// -------------------------------------------
	//mail($to,$subject,$message,$headers);
	// return true;
	// -------------------------------------------
}

function nonreg_missing_send_mail($dbc, $date, $time, $location, $description, $returnlocation, $contactfield, $serialnumber){

	$parkingphone = $_SERVER['parkingphone'];
	$parkingemail = $_SERVER['parkingemail'];
	$securityphone = $_SERVER['securityphone'];
	$securityemail = $_SERVER['securityemail'];
	$kingstonpolicephone = $_SERVER['kingstonpolicephone'];
	$kingstonpoliceemail = $_SERVER['kingstonpoliceemail'];

	$query = mysqli_query($dbc, "SELECT * from user,bicycle WHERE serial='$serialnumber';");
  $row = mysqli_fetch_assoc($query);
  $to = $row['Email'];
  $name = $row['Name'];

switch ($returnlocation) {
    case 'security' :
      $locationmessage = "Campus Security. Phone: ".$securityphone." E-mail: ".$securityemail;
      break;
    case 'parking' :
      $locationmessage = "Campus Parking. Phone: ".$parkingphone." E-mail: ".$parkingemail;
      break;
    case 'police' :
      $locationmessage = "Kingston Police. Phone: ".$kingstonpolicephone." E-mail: ".$kingstonpoliceemail;
      break;
    case 'directContact' :
      $locationmessage = "Direct Contact. Phone or E-mail: ".$contactfield;
      break;
  }

	$subject = "Your Missing Bicycle has been Reported Found";

	$message = "
	<html>
	<head>
	<title>Your Missing Bicycle has been Reported Found</title>
	</head>
	<body>
	<p>Hello ".$name."</p>
	<p>The Following information was provided by the person who found your missing bicycle. Please keep it on file.</p>
	<p>Bicycle Serial Number: ".$serialnumber."</p>
	<p>Date Found: ".$date."</p>
	<p>Time Found: ".$time."</p>
	<p>Location Found: ".$location."</p>
	<p>Other Information: ".$description."</p>
	<p>The person provided this return method: ".$locationmessage."</p>
	</body>
	</html>
	";

	// always set content-type for HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// More Header
	$headers .= 'From: Queens Bicycle Registration System<Do-Not-Reply@Queensu.ca>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

	// The following 4 lines of code are for testing the email function on localhost.
	// Comment them out when moving to the PROD server.
	// ------------------------------------------------------------
	echo $to;
	echo $subject;
	echo $message;
	echo $headers;
	return false;
	// -----------------------------------------------------------
	// The following 2 lins of code are MUST be uncommented when this code runs on the PROD server.
	// -------------------------------------------
	//mail($to,$subject,$message,$headers);
	// return true;
	// -------------------------------------------
}


?>