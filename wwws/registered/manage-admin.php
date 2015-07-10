<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
	include_once '../../lib/search.func.php';
?>

<section id="admin-basic">
</br>
<table align="center">
	<tr>
    	<td>
	    	<b>Edit Administrator: </b><br/>
			</td>
	</tr>
	<tr>
		<td>
			NetID:
		</td>
<form method="post">
		<td style='padding-right: 10px;'>
			<input CLASS="form-control" type="text" name="adminQuery" value="">
		</td>

		<td>
			<button class="btn btn-primary" name='submit' value='1'>
				<span class='glyphicon glyphicon-plus'></span> Add
			</button>
			<button class="btn btn-primary" name='submit' value='2'>
				<span class='glyphicon glyphicon-minus'></span> Remove
			</button>
		</td>
	</tr>
</form>
	<tr><td></br></td>
	</tr>
	<tr>
		<td>
			Receive Emails: <br/>
		</td>
	<form method="post">
		<td>
			<input type='checkbox' value='1' name='checket'
				<?php if((get_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID']) != 0)){echo "checked='checked'";} ?>>
			</input> &nbsp
				<?php
					if((get_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID']) != 0)) {
						echo '<input type="hidden" name="checked_value" value="1">';
					} else {
						echo '<input type="hidden" name="checked_value" value="0">';
					}
				?>
			<button class="btn btn-primary" name='get_email' value='1'>Save</button>
		</td>
	</tr>
</form>
</table>
<?php
	if (isset($_POST['submit']) AND $_POST['submit'] == 1) {
		$result = add_admin($dbc, $_POST['adminQuery']);
		if ($result == 1) {
			echo "<br>Admin successfully added.";
		} else {
			echo "<br>Unable to add admin.";
		}
	}

	if (isset($_POST['submit']) AND $_POST['submit'] == 2) {
		$result = remove_admin($dbc, $_POST['adminQuery']);
		if ($result == 1) {
			echo "<br>Admin successfully removed.";
		} else {
			echo "<br>Unable to remove admin.";
		}
	}

	if (isset($_POST['get_email'])) {
		if (isset($_POST['checket'])) {
			$var = set_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID'], 1);
		} else {
			$var = set_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID'], 0);
		}
		if ($var == 1) {
?>
		<script language="JavaScript">
			window.location.href = './manage-admin.php';
		</script>
<?php
		} else {
			echo "<br>Unable to remove you for the mailing list.
						<br>You are the only admin receiving e-mails.";
		}
	}
?>
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
		<form method="link" action="./home.php">
			<button class="btn btn-primary" id="admin-button">Manage Personal Bicycles</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./admin.php">
			<button class="btn btn-primary" id="admin-button">Admin Home</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./edit-links.php">
			<button class="btn btn-primary" id="admin-button">Edit Useful Links</button>
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

</section>

<?php
	include_once '../includes/footer.php';
?>