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
<table align="center" style="padding:5%;margin-top:5%">
	<tr align="center"><td align="center"><b>Useful Links</b></td></tr>
	<tr>
		<td align="center" style="padding-bottom:5%">
<?php
		$links_array = load_useful_links($link_file);
		foreach ($links_array as $link_info) {
			echo '<a href="'.$link_info[1].$link_info[2].'" title="'.$link_info[0].'" target="new">'.$link_info[0].'</a><br/>';
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
