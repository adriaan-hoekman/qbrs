<html>
<?php
	include_once './includes/header.php';
?>

<body>
<table cellspacing="50" align="center">
	<tr>
		<td>
			<!-- Blank Cell under the Queens Logo. -->
		</td>
		<td align="center">
			<br />
			<h2>Found a bicycle?</h2>
			<h3>Enter the serial number here to check if it has been reported missing:</h3>
				<!-- <input name="SerialSearch" type="text" id="SerialSearch" value="Enter Serial Number here to Search" size="50" -->

			<FORM METHOD="POST" ACTION="search-result.php">
			<INPUT TYPE="TEXT" NAME = "SerialNumber" placeholder="Enter Serial Number here and Click Search" size="50">
			<INPUT TYPE="submit" VALUE="Search">
			</FORM>
		</td>
	</tr>
</table>
</body>

<?php
	include_once './includes/footer.php';
?>
