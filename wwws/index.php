<html>
<?php
	include_once './includes/header.php';
	include_once '../lib/header.func.php';
	include_once '../lib/global.conf.php';
?>

<body>
<div class="container">
<table cellspacing="50" align="center">
	<tr>
		<td>
			<!-- Blank Cell under the Queens Logo. -->
		</td>
		<td align="center">
			<br />
			<h3>Found a bicycle?</h3>
			<h4>Enter the serial number here to check if it has been reported missing:</h4>
			<h4>(Or leave the field blank and click Search to file a report without a serial number)</h4>
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
	<tr>
		<td>
		</td>
		<td align="center">
			<?php
  echo "<br />";
  echo "Number of bicycles returned: ".implode('',returned_bicycles_count($dbc));
			?>
		</td>
	</tr>
</table>
</div>
</body>

<?php
	include_once './includes/footer.php';
?>
