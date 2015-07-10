<?php
	include_once './includes/header.php';
	include_once '../lib/global.conf.php';
	include_once '../lib/reg.func.php';
	include_once '../lib/search.func.php';
?>

<nav>
  <h3>
	SEARCH RESULTS
  </h3>
</nav>

<section>	
	<?php
	$serialnumber = $_POST['SerialNumber'];
  // If the serialnumber is NULL, it was left blank on the last page, and therefore the user does not have the serial number
  // so the user is sent to the no serial missing report page.
  if ($serialnumber == NULL) {
    header('location: ./no-serial-missing-report.php');
  }
	$results = search_serial_nonreg ($dbc,$serialnumber);
	if ($results == 0){
    // if no bicycle is found in the database matching the entered search number
    ?>
		<h4>No bicycles matching the entered serial number were found.</h4>

    <input class="btn btn-primary" type="button" value="Cancel" onClick="window.location.href='./index.php'">
  <?php
	} else {
    // If a bicycle is found with a matching serial number, a user can choose to submit a report or cancel
    ?>
    <h4>
	    A bicycle matching that serial number is registered.
    </h4>
	  <br />
    If you would like to report the bicycle found, please click the Report button below
    <br />
    Otherwise, click the Cancel button to return to the main page
    <br />
    <br />
    <FORM METHOD="POST" ACTION="nonreg-missing-report.php">
    <input type="hidden" name="SerialNumber" value="<?php echo htmlspecialchars($serialnumber); ?>">
    <INPUT class="btn btn-primary" TYPE="submit" VALUE="Report">
    <input class="btn btn-primary" type="button" value="Cancel" onClick="window.location.href='./index.php'">
    </FORM>
    <?php
	 }
	?>
</section>


<?php
	include_once './includes/footer.php';
?>
