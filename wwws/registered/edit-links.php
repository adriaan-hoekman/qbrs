<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
	include_once '../../lib/search.func.php';
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
    $('#edit-links-table a').editable();
    });
</script>

<section id="admin-basic" align='center'>
<h3 align='center'>Useful Links</h3>
<?php
	$current_links = get_useful_links($dbc);
	echo "<table class='table-responsive' id='edit-links-table' style='width: 85%; margin-left: 10%;' align='center'>";
	echo "<tr>
					<th id='link-show-th' style='padding: 1%;'>Link Description</th>
					<th id='link-show-th' style='padding: 1%;'>Link URL</th>
			</tr>";
	while ($row = mysqli_fetch_assoc($current_links)) {
		echo "<td id='link-show-td' style='padding: 1%;'><div class='hidden-xs'>
						<a href='#' id='linkDesc' data-type='text' data-pk='".$row['LinkID']." data-linkdesc='".$row['Description']."' data-url='edit-link.php'>".$row['Description']."</a>
					</div></td>
					<td id='link-show-td' style='padding: 1%;'><div class='hidden-xs'>
						<a href='#' id='linkUrl' data-type='text' data-pk='".$row['LinkID']." data-linkurl='".$row['Url']."' data-url='edit-link.php'>".$row['Url']."</a>
					</div></td>
					<td id='link-delete-td' style='padding-left: 2%; vertical-align: bottom;'><div class='hidden-xs'>
						<form method='post' action='edit-link.php'>
							<button class='btn btn-danger' type='submit'><span class='glyphicon glyphicon-remove'></span></button>
							<input type='hidden' name='deleteLink' value='".$row['LinkID']."'>
						</form>
					</div></td>";
		echo "</tr>";
	}
	echo "</table>";
?>
</br>
<form method="post" action="edit-link.php">
	<button class="btn btn-primary" type="submit">
		<span class='glyphicon glyphicon-plus'></span> Add Link
	</button>
	<input type='hidden' name='addLink' value='<?php count($current_links); ?>'>
</form>
</section>

<aside>
<table align="center">
<?php
	$result = search_missing($dbc);
	if (empty($result) == False) {
		echo "<tr><td>";
		echo '<ul style="list-style-type:none;padding:0;">';
		echo '<li><h4 style="margin-bottom:0.2em;">Missing Bicycles</h4></li>';
		echo '<div class="panel panel-default" style="border:1px solid black;padding:5px;height:80px;overflow: scroll;">';
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<li>".$row['Serial']."</li>";
		}
		echo "</ul>";
		echo "</div>";
		echo "</td></tr>";
	}
?>
	<tr>
		<td>
		<form method="link" action="./admin.php">
			<button class='btn btn-primary' id="admin-button">Admin Home</button>
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
	<tr>
		<td>
		<form method="link" action="./home.php">
			<button class='btn btn-primary' id="admin-button">Manage Personal Bicycles</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./generate-report.php">
			<button class="btn btn-primary" id="admin-button">Generate Spreadsheet</button>
		</form>
		</td>
	</tr>
</table>
</aside>

<section id="admin-results">
<?php
	if (isset($_POST['save']) AND $_POST['save'] == 1) {
		$result = set_useful_links($dbc, $_POST['new_links']);
		if ($result == 1) {
			echo "Links successfully saved.";
		} else {
			echo "Unable to save links.";
		}
	}
?>
</section>

<?php
	include_once '../includes/footer.php';
?>