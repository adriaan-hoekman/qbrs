<DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/includes/styles.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  	<title>Queen's Bicycle Registration System</title>
</head>

<body>
<header>
<table cellspacing="50" align="center" border =1>
	<tr>
		<td>
		<?php
			echo '<img src=/images/Queens_logo.png width="192" height="146">';
		?>
		</td>
    <td align="center" width=550px>
			<h1>Queens Bicycle Registration System</h1>
    </td>
      <?php
      	if (strpos(dirname($_SERVER['PHP_SELF']), 'registered') !== FALSE)
      	{
					echo '<td align="center" width=100px>';
					echo '<FORM METHOD="LINK" ACTION="../index.php">';
					echo '<INPUT TYPE="submit" VALUE="Login">';
  				echo "</FORM>";
	  			echo "</td>";
        } else {
        	echo '<td align="center" width=100px>';
					echo '<FORM METHOD="LINK" ACTION="./registered/index.php">';
					echo '<INPUT TYPE="submit" VALUE="Login">';
  				echo "</FORM>";
	  			echo "</td>";
        }
        ?>
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
