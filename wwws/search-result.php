<?php
	include_once '/includes/header.php';
	include_once '../lib/global.conf.php';
	include_once '../lib/reg.func.php';
	include_once '../lib/search.func.php';
?>

<nav>
  <h1>
	SEARCH RESULTS
  </h1>
</nav>

<section>	
	<?php
	$serialnumber = $_POST['SerialNumber'];
	//echo $serialnumber;
	$results = search_serial_nonreg ($dbc,$serialnumber);
	if ($results == 0){
		echo "No bicycles matching the entered serial number were found.";
	} else {
    echo '<h2>';
		echo "A bicycle matching that serial number has been found.";
    echo "</h2>";
		echo "<br />";
    echo "If you would like to report the bicycle found, please click the Report button below";
    echo "<br />";
    echo "Otherwise, click the Cancel button to return to the main page";
    echo "<br />";
    echo "<br />";
    //echo '<td align="center" width=100px>';
    echo '<FORM METHOD="POST" ACTION="nonreg-missing-report.php">';
    echo '<INPUT TYPE="submit" VALUE="Submit">';
    echo "</FORM>";
    echo '<FORM METHOD="LINK" ACTION="../index.php">';
    echo '<INPUT TYPE="submit" VALUE="Cancel">';
    echo "</FORM>";
    //echo "</td>";
	 //echo implode($results," ");
	}
	?>
</section>


<?php
	include_once './includes/footer.php';
?>
