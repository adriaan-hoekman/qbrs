<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
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
		<td>
			<input CLASS="form-control" type="text" name="adminQuery" value="">
		</td>
	</tr>
	<tr>
		<td>
			<button class="btn btn-primary" name='submit' value='1'>Add</button>
			<button class="btn btn-primary" name='submit' value='2'>Remove</button>
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
			<button class="btn btn-primary" name='get_email' value='1'>Save</button>
		</td>
	</tr>
</form>
</table>
</section>

<aside>
<table align="center">
	<tr>
		<td>
		<form method="link" action="./admin.php">
			<button class="btn btn-primary" id="admin-button">Admin Home</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./home.php">
			<button class="btn btn-primary" id="admin-button">Manage Personal Bicycles</button>
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
	<tr>
		<td>
		<form method="link" action="./edit-links.php">
			<button class="btn btn-primary" id="admin-button">Edit Useful Links</button>
		</form>
		</td>
	</tr>
</table>
</aside>

<section id="admin-results">
<?php
	if (isset($_POST['submit']) AND $_POST['submit'] == 1) {
		$result = add_admin($dbc, $_POST['adminQuery']);
		if ($result == 1) {
			echo "Admin successfully added.";
		} else {
			echo "Unable to add admin.";
		}
	}

	if (isset($_POST['submit']) AND $_POST['submit'] == 2) {
		$result = remove_admin($dbc, $_POST['adminQuery']);
		if ($result == 1) {
			echo "Admin successfully removed.";
		} else {
			echo "Unable to remove admin.";
		}
	}

	if (isset($_POST['get_email'])) {
		if (get_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID']) == 0) {
			set_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID'], 1);
		} else {
			set_get_email($dbc, $_SERVER['HTTP_QUEENSU_NETID'], 0);
		}
		header("Location: manage-admin.php");
	}
?>
</section>

<?php
	include_once '../includes/footer.php';
?>