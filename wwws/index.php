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
        	<h3>Enter the Serial Number Here to search for a Bicycle:</h3>
        	<!-- <input name="SerialSearch" type="text" id="SerialSearch" value="Enter Serial Number here to Search" size="50" -->

          <FORM METHOD="POST" ACTION="search-result.php">
					<INPUT TYPE="TEXT" NAME = "SerialNumber" placeholder="Enter Serial Number here and Click Search" size="50">
					<INPUT TYPE="submit" VALUE="Search">
					</FORM>
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
	include_once './includes/footer.php';
?>
