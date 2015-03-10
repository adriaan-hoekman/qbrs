<?php


function missing_send_mail($to, $name){
	$subject = "This is Your Missing Report";

	$message = "
	<html>
	<head>
	<title>This is Your Missing Report</title>
	</head>
	<body>
	<p>Hi ".$name."</p>
	<p>The Following information is your missing report. Please keep on file for furture uses.</p>
	</body>
	</html>
	";

	// always set content-type for HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// More Header
	$headers .= 'From: Queens Bicycle Registration System<Do-Not-Reply@Queensu.ca>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";

	mail($to,$subject,$message,$headers);
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
      $locationmessage = "Campus Security. Phone: ".$securityphone." Email: ".$securityemail;
      break;
    case 'parking' :
      $locationmessage = "Campus Parking. Phone: ".$parkingphone." Email: ".$parkingemail;
      break;
    case 'police' :
      $locationmessage = "Kingston Police. Phone: ".$kingstonpolicephone." Email: ".$kingstonpoliceemail;
      break;
    case 'directContact' :
      $locationmessage = "Direct Contact. Phone or Email: ".$contactfield;
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
	<p>The Following information was provided by the person who found your missing bicycle. Please keep on file.</p>
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