<?php
	include_once '../includes/header.php';
?>

<body>
<table cellspacing="50" align="center">
	<tr>
    	<td>
        	<!-- Blank Cell under the Queens Logo. -->
        </td>
    	<td align="center">
        	<h1>YOU LOGGED IN AS CYCLIST</h1>
  			<?php

			include_once '../../lib/global.conf.php';
			include_once '../../lib/reg.func.php';

			date_default_timezone_set("America/Toronto");

			$netid = $_SERVER['HTTP_QUEENSU_NETID'];
			$name = $_SERVER['HTTP_COMMON_NAME'];
			$email = $_SERVER['HTTP_QUEENSU_MAIL'];
			$da = date("Y-m-d H:i:s");

    		echo "Hello Cyclist ".$name;
			echo "<br />";
    		echo "Your NetID is ".$netid;
			echo "<br />";
    		echo "Your Email is ".$email;
			echo "<br />";
			echo "System Time is: ".$da;
  			?>
        </td>
	</tr>
    <tr>
    	<td>
        	<!-- Blank Cell under the Queens Logo. -->
        </td>
        <td align="center">
        	<a href="http://youtu.be/JgHubY5Vw3Y" title="Video - How to properly lock your bicycle" target="new">Video - How to properly lock your bicycle</a>
            <br />
            <a href="http://www.cyclekingston.ca/" title="CYCLE Kingston" target="new">CYCLE Kingston</a>
            <br />
        </td>
</table>
</body>

<?php
	include_once '../includes/footer.php';
?>
