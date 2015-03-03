<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
?>

<nav>
<h1>ADMINISTRATOR MANAGEMENT</h1>
</nav>

<section id="admin-basic">
<table align="center">
	<tr>
    	<td>
	    	Edit Administrator: <br/>
			</td>
	</tr>
	<tr>
		<td>
			NetID:
		</td>
<form method="post">
		<td>
			<input type="text" name="adminQuery" value="">
		</td>
	</tr>
	<tr>
		<td>
			<button name='submit' value='1'>Add</button>
			<button name='submit' value='2'>Remove</button>
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
			<button id="admin-button">Admin Home</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./home.php">
			<button id="admin-button">Manage Personal Bicycles</button>
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form method="link" action="./generate-report.php">
			<button id="admin-button">Generate Report</button>
		</form>
		</td>
	</tr>
</table>
</aside>

<section id="admin-results">
<?php
	if(isset($_POST['submit']) AND $_POST['submit'] == 1) {
		$result = add_admin($dbc, $_POST['adminQuery']);
		if ($result == 1) {
			echo "Admin successfully added.";
		} else {
			echo "Unable to add admin.";
		}
	}

	if(isset($_POST['submit']) AND $_POST['submit'] == 2) {
		$result = remove_admin($dbc, $_POST['adminQuery']);
		if ($result == 1) {
			echo "Admin successfully removed.";
		} else {
			echo "Unable to remove admin.";
		}
	}
?>
</section>

<?php
	include_once '../includes/footer.php';
?>