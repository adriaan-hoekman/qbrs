<DOCTYPE html>
<html>
<head>
	<!-- Bootstrap and JQuery CSS -->
	<link href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen">

	<!-- Bootstrap and JQuery JS -->	
	<script src="https://code.jquery.com/jquery-1.11.2.js"></script>
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

	<!-- Inline Editing JS and CSS -->
	<link href="/includes/css/bootstrap-editable.css" rel="stylesheet">
	<script src="/includes/js/bootstrap-editable.js"></script>

	<!-- Custom Style -->
	<link rel="stylesheet" href="/includes/css/styles.css">
  <title>Queen's Bicycle Registration System</title>
</head>

<body>
<header>
<table cellspacing="50" align="center">
	<tr>
		<td>
		<?php
			echo '<img src=/images/Queens_logo.png width="192" height="146">';
		?>
		</td>
    <td align="center" width=550px>
			<h2>Queen's Bicycle Registration System</h2>
    </td>
    <td>
		<?php
			if (strpos(dirname($_SERVER['PHP_SELF']), 'registered') !== FALSE)
			{
				echo '<td align="center" width=100px>';
				echo '<FORM>';
				echo '<INPUT class="btn btn-default" TYPE="button" VALUE="Logout" onClick="parent.location=\'https://login.queensu.ca/idp/logout.jsp?goto=https://webapp.queensu.ca/pps/qbrs/\'">';
				echo "</FORM>";
				echo "</td>";
			} else {
				echo '<td align="center" width=100px>';
				echo '<FORM METHOD="LINK" ACTION="./registered/index.php">';
				echo '<INPUT class="btn btn-default" TYPE="submit" VALUE="Login">';
				echo "</FORM>";
				echo "</td>";
			}
		?>
	</td>
	</tr>
</table>
</header>

<?php
	// Test version of different browser
	$timestamp = time();
	$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	//$via = $_GET['via'];

	if($user_agent){
    	$is_mobie = preg_match('/(Mobile|iPod|iPhone|Android|Opera Mini|BlackBerry|webOS|UCWEB|Blazer|PSP)/i', $user_agent);
    	if($is_mobie){
        	// Set Mobie Version
        	setcookie('mtpl', 'True', $timestamp+86400 * 365, '/'); // Set Cookie
    	}else{
        	// Set Desktop Version
        	setcookie('mtpl', 'False', $timestamp+86400 * 365, '/'); // Set Cookie
    	}
	}else{
    	//exit('error: 400 no agent');
	}

?>
