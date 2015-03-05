<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
?>

<nav>
<h3 align='center'>GENERATE SPREADSHEET</h3>
</nav>

<section id="admin-basic"  align='center'>
<table align="center" style="width:60%">
<form method="post">
	<tr>
		<td style='padding-right:5%'><b>Bicycles:</b></td><td><b>Reports:</b></td>
	</tr>
	<tr>
		<td style='padding-right:5%'>
<?php
			echo "<button class='btn btn-primary' id='admin-button' name='submit' value='1'>All Bicycles</button>";
			echo "<button class='btn btn-primary' id='admin-button' name='submit' value='2'>Missing Bicycles</button>";
			echo "<button class='btn btn-primary' id='admin-button' name='submit' value='3'>Not Missing Bicycles</button>";
?>
		</td>
		<td>
<?php
			echo "<button class='btn btn-primary' id='admin-button' name='submit' value='4'>All Reports</button>";
			echo "<button class='btn btn-primary' id='admin-button' name='submit' value='5'>Missing Reports</button>";
			echo "<button class='btn btn-primary' id='admin-button' name='submit' value='6'>Found Reports</button>";
?>
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

<section id="admin-results">
<?php
	if(isset($_POST['export'])) {
		$result = report_to_csv($dbc, $_POST['export']);
		if ($result === 1) {
			echo "Report successfully generated.";
		} else {
			echo "Unable to generate Report.";
		}
		$_POST['submit'] = $_POST['export'];
	}

	if(isset($_POST['submit'])) {
		$result = generate_report($dbc, $_POST['submit']);

		if ($result != false && $result -> num_rows != 0) {
			echo "<h3>".get_report_name($_POST['submit'])."</h3>";
			echo "<form method='post'> <button class='btn btn-primary' id='admin-report-button' name='export' value='".$_POST['submit']."'>Download</button></form>";
			echo "<table class='table table-striped table-hover' id='admin-search' align='center'>";

			if ($_POST['submit'] < 4) {
?>
					<tr>
						<th id="admin-th">NetID</th>
						<th id="admin-th">Serial Number</th>
						<th id="admin-th">Make</th>
						<th id="admin-th">Model</th>
						<th id="admin-th">Missing</th>
					</tr>
<?php
					while($row = mysqli_fetch_assoc($result)){
						$missing = ($row['Missing'] == 0 ? "No" : "Yes");
						echo "<tr>
									<td id='admin-search-td'>".$row['NetID']."</td>
									<td id='admin-search-td'>".$row['Serial']."</td>
									<td id='admin-search-td'>".$row['Make']."</td>
									<td id='admin-search-td'>".$row['Model']."</td>
									<td id='admin-search-td'>".$missing."</td>
									</tr>";
					}
			} else if ($_POST['submit'] === 5) {
?>
					<tr>
						<th id="admin-th">Serial Number</th>
						<th id="admin-th">Date</th>
						<th id="admin-th">Time</th>
						<th id="admin-th">Location</th>
						<th id="admin-th">Description</th>
					</tr>
<?php
					while($row = mysqli_fetch_assoc($result)){
						echo "<tr>
									<td id='admin-search-td'>".$row['Bicycle.Serial']."</td>
									<td id='admin-search-td'>".$row['Date']."</td>
									<td id='admin-search-td'>".$row['Time']."</td>
									<td id='admin-search-td'>".$row['Location']."</td>
									<td id='admin-search-td'>".$row['Description']."</td>
									</tr>";
					}
			} else {
?>
					<tr>
						<th id="admin-th">Serial Number</th>
						<th id="admin-th">Date</th>
						<th id="admin-th">Time</th>
						<th id="admin-th">Location</th>
						<th id="admin-th">Description</th>
						<th id="admin-th">Return</th>
					</tr>
<?php
				while($row = mysqli_fetch_assoc($result)){
					$return_location = get_report_location($row['ReturnLocation']);

					echo "<tr>
								<td id='admin-search-td'>".$row['Serial']."</td>
								<td id='admin-search-td'>".$row['Date']."</td>
								<td id='admin-search-td'>".$row['Time']."</td>
								<td id='admin-search-td'>".$row['Location']."</td>
								<td id='admin-search-td'>".$row['Description']."</td>
								<td id='admin-search-td'>".$return_location."</td>
								</tr>";
				}
			}
			echo "</table>";
		} else if ($_POST['submit'] < 4) {
			echo "No bicycles could be found matching those criteria.";
		} else if ($_POST['submit'] > 3) {
			echo "No reports could be found matching those criteria.";
		} else {
			echo "Something went wrong while trying to generate the Report.";
		}
	}
?>
</section>

<?php
	include_once '../includes/footer.php';
?>