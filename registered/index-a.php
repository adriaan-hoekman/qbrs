<html>
<head>
  <title>Queens Bicycle Registration System</title>
</head>
<body>
  <h1>YOU LOGGED IN</h1>
  <?php
  
	include_once '../lib/global.conf-a.php';
	
	$netid = $_SERVER['HTTP_QUEENSU_NETID'];
	$name = $_SERVER['HTTP_COMMON_NAME'];
	$email = $_SERVER['HTTP_QUEENSU_MAIL'];
	$d1 = new DateTime("2014-11-21 12:30:00");
	
	echo "Hello ".$name;
	echo "<br />";
    echo "Your NetID is ".$netid;
	echo "<br />";
    echo "Your Email is ".$email;
	echo "<br />";
	
	$result = mysqli_query($dbc, "INSERT INTO Users (NetID, Name, Email, RegistrationDate) VALUES ($netid, $name, $email, $d1)")
		or die ("Couldn't execute query.");
	echo "<br />";

  ?>
  <FORM>
	<INPUT TYPE="button" VALUE="Logout" onClick="parent.location='https://idptest.queensu.ca/idp/logout.jsp?goto=https://webappdev.queensu.ca/pps/qbrs/'">
	</FORM>
</body>
</html>
