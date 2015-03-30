<?php
	if (strpos($_SERVER['REQUEST_URI'], 'registered') !== FALSE) {
    include_once '../../lib/links.func.php';
    $link_file = "../includes/useful_links.txt";
	} else {
    include_once '../lib/links.func.php';
    $link_file = "./includes/useful_links.txt";
	}
?>

<footer>
<div class="container">
<table align="center" style="margin-top:2%">
	<tr align="center"><td align="center" style='padding-bottom: 5px;'><b>Useful Links</b></td></tr>
	<tr>
		<td align="center" style="padding-bottom:5%">
<?php
		$result = get_useful_links($dbc);
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<a href="'.$row['Url'].'" title="'.$row['Description'].'" target="new">'.$row['Description'].'</a><br/>';
		}
?>
		</td>
	</tr>
	<tr style="font-size:75%">
		<td>
			Created By Luke Dowker, Adriaan Hoekman, and David Jiang
		</td>
	</tr>
</table>
</div>
</footer>
</body>
</html>
