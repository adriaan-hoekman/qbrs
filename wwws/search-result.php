<?php
	include_once './includes/header.php';
	include_once '../lib/global.conf.php';
	include_once '../lib/search.func.php';
?>

<section id="non-reg-search">
<nav>
<h1>Search Results</h1>
</nav>
<table align="center">
	<tr>
    	<td>
        	<!-- Blank Cell under the Queens Logo. -->
      </td>
    	<td>
				<?php
					$serialnumber = $_POST['SerialNumber'];
					//echo $serialnumber;
					$results = search_serial ($dbc,$serialnumber);
					if ($results == 0){
						echo "No bicycles matching the entered serial number were found";
					} else {
						echo "A bicycle matching that serial number has been found";
					}
				?>
      </td>
	</tr>
    <tr>
    	<td>
        	<!-- Blank Cell under the Queens Logo. -->
        </td>
        <td align="center">

        </td>
</table>
</section>

<?php
	include_once './includes/footer.php';
?>
