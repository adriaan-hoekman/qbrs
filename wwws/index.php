<html>
<?php
	include_once './includes/header.php';
	include_once '../lib/header.func.php';
	include_once '../lib/global.conf.php';

	/*
		This is the main index page for the system, and what is displayed when no specific file is referenced it the url.
		from this page, registered and non registered users can search the database for a bicycle using a serial number, or 
		by leaving the serial number field blank, submit a missing report without knowing the serial number of the bicycle.
	*/
?>

<body>
<div class="container">
<table align="center">
	<tr>
		<td style="padding: 10px">
			<div class="hidden-xs">
			<img src="/images/default_bicycle.png" width="240" height="144">
		</div>
		</td>
		<td align="left">
			<div class="hidden-xs">
			<h4>
				Do you own a bicycle? Afraid of losing it?
			</h4>
			<h4>
				Login now with your NetID to register your bicycle!
			</h4>
			<h4>
				Doing so will allow us to help you recover your bicycle if it is stolen or lost!
			</h4>
			<h4>
				Not part of the Queen's community? No worries, report a bicycle missing below!
			</h4>
		</div>
		</td>
	</tr>
</div>
</table>


<table cellspacing="50" align="center">
	<tr>
		<td>
		</td>
		<td align="center">
<?php
			echo "<br/>";
			echo "Number of bicycles returned to owner: ".implode('',returned_bicycles_count($dbc));
?>
		</td>
	</tr>
	<tr>
		<td>
			<!-- Blank Cell under the Queens Logo. -->
		</td>
		<td align="center">

			<h3>Found a bicycle?</h3>
			<h4>Enter the serial number here to check if it has been reported missing:</h4>
			<h5>(Can't find a serial number? Just click Search to file a report without one)</h5>
			<FORM METHOD="POST" ACTION="search-result.php">
			<div class="col-lg-10">
			<INPUT CLASS="form-control" TYPE="TEXT" NAME = "SerialNumber" placeholder="Enter Serial Number here and Click Search" size="50">
			</div>
			<div class="col-lg-2">
			<button type="submit" class="btn btn-primary">
				<span class="glyphicon glyphicon-search"></span> Search
			</button>
			</div>
			</FORM>
		</td>
	</tr>
</table>
</div>
</body>

<?php
	include_once './includes/footer.php';
?>
