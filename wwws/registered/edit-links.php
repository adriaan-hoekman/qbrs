<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
	include_once '../../lib/links.func.php';
?>

<script type="text/javascript">
    type = "";
    $('#inline').change(function() {
        type = $(this).val();
        console.log((type != "" ? "inline" : "popup"));
        $.fn.editable.defaults.mode = (type != "" ? "inline" : "popup");
    });

    $(document).ready(function() {
    $.fn.editable.defaults.mode ="inline";
    $('#cyclist-show a').editable();
    $('#phoneNumber').editable();
    });
</script>

<nav>
<h3 align='center'>EDIT USEFUL LINKS</h3>
</nav>

<section id="admin-basic"  align='center'>
<?php
	$current_links = load_useful_links("../includes/useful_links.txt");

	echo "<table class='table-striped table-hover' id='cyclist-show' align='center'>";
	echo "<tr>
					<th id='link-show-th'>Link Description</th>
					<th id='link-show-th'>Link URL</th>
			</tr>";
	foreach ($current_links as $link_info) {
			echo "<td id='link-show-td'><a href='#' id='linkDesc' data-type='text' data-pk='".$link_info[0]."' data-url='edit-links.php'>".$link_info[0]."</a></td>
						<td id='link-show-td'><a href='#' id='linkUrl' data-type='text' data-pk='".$link_info[1]."' data-url='edit-links.php'>".$link_info[1].$link_info[2]."</a></td>";
					echo "</tr>";
	}
	echo "</table>";
?>
</section>

<aside>
<table align="center">
	<tr>
		<td>
		<form method="link" action="./admin.php">
			<button class='btn btn-primary' id="admin-button">Admin Home</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./home.php">
			<button class='btn btn-primary' id="admin-button">Manage Personal Bicycles</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./manage-admin.php">
			<button class='btn btn-primary' id="admin-button">Manage Administrators</button>
		</form>
		</td>
	</tr>
</table>
</aside>



<?php
	include_once '../includes/footer.php';
?>