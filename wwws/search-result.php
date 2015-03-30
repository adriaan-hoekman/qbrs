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
	$results = search_serial_nonreg ($dbc,$serialnumber);
	if ($results == 0){
    ?>
		<h4>No bicycles matching the entered serial number were found.</h4>

    <input class="btn btn-primary" type="button" value="Cancel" onClick="window.location.href='./index.php'">
  <?php
	} else {
  ?>
  <h4>
	A bicycle matching that serial number has been found.
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
