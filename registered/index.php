<html>
<head>
  <title>Queens Bicycle Registration System</title>
</head>
<body>
  <h1>YOU LOGGED IN</h1>
  <?php
  
	include_once '../lib/global.conf.php';
	
    echo "Hello ".$_SERVER['HTTP_COMMON_NAME'];
	echo "<br />";
    echo "Your NetID is ".$_SERVER['HTTP_QUEENSU_NETID'];
	echo "<br />";
    echo "Your Email is ".$_SERVER['HTTP_QUEENSU_MAIL'];
	echo "<br />";
	
	//$result = mysqli_query($dbc, "INSERT INTO Users (NetID, Name, Email, Phone, RegistrationDate) VALUES ('$_SERVER['HTTP_QUEENSU_NETID']', '$_SERVER['HTTP_COMMON_NAME']', '$_SERVER['HTTP_QUEENSU_MAIL']', '0', '2014-11-21 12:30:00')");

  ?>
  <FORM>
	<INPUT TYPE="button" VALUE="Logout" onClick="parent.location='https://idptest.queensu.ca/idp/logout.jsp?goto=https://webappdev.queensu.ca/pps/qbrs/'">
	</FORM>
</body>
</html>
