<html>
<head>
  <title>Queens Bicycle Registration System</title>
</head>
<body>
  <h1>YOU LOGGED IN</h1>
  <?php

	include_once '../lib/global.conf.php';
	include_once '../lib/reg.func.php';

	date_default_timezone_set("America/Toronto");

	$netid = $_SERVER['HTTP_QUEENSU_NETID'];
	$name = $_SERVER['HTTP_COMMON_NAME'];
	$email = $_SERVER['HTTP_QUEENSU_MAIL'];
	$da = date("Y-m-d H:i:s");

    echo "Hello ".$name;
	echo "<br />";
    echo "Your NetID is ".$netid;
	echo "<br />";
    echo "Your Email is ".$email;
	echo "<br />";
	echo "System Time is: ".$da;

	// $result = mysqli_query($dbc, "INSERT INTO Users (NetID, Name, Email, RegistrationDate) VALUES ('$netid', '$name', '$email', '$da')")
	// 	or die ("Couldn't execute query.");
	// echo "<br />";

	if(is_registered($netid) == 0){
		echo '<script>alert("User in the Database")</script> ';
	}else{
		echo '<script>alert("You can Register!~")</script>';
	}

  ?>
  <FORM>
	<INPUT TYPE="button" VALUE="Logout" onClick="parent.location='https://login.queensu.ca/idp/logout.jsp?goto=https://webapp.queensu.ca/pps/qbrs/'">
	</FORM>
</body>
</html>
