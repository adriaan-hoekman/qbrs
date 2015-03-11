<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/search.func.php';
	include_once '../../lib/admin.func.php';
?>

<nav>
<h3 align="center">ADMINISTRATOR</h3>
</nav>

<div class="container" align='center'>
<section id="admin-basic">

<ul class="nav nav-tabs">
	<li class="active"><a href="#bicycle-tab" data-toggle="tab" aria-expanded="true">Bicycles</a></li>
	<li class=""><a href="#report-tab" data-toggle="tab" aria-expanded="false">Reports</a></li>
	<li class=""><a href="#user-tab" data-toggle="tab" aria-expanded="false">Users</a></li>
</ul>

<form method="post" action="admin.php">
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade active in" id="bicycle-tab">
		<input type="hidden" name="bicycleSearch" value="1">
		<br/>
		<table align="center">
			<tr>
				<td>
					<b>Search for Bicycles by:</b>
					<br/>
				</td>
			</tr>
			<tr>
				<td>
					Serial Number:
				</td>
				<td>
					<input CLASS="form-control" type="text" name="serialQuery" value="">
				 </td>
			</tr>
			<tr>
				<td>
					Make:
				</td>
				<td>
					<input CLASS="form-control" type="text" name="makeQuery" value="">
				</td>
			</tr>
			<tr>
				<td>
					Model:
				</td>
				<td>
					<input CLASS="form-control" type="text" name="modelQuery" value="">
				</td>
			</tr>
			<tr>
				<td>
					Missing:
				</td>
				<td>
					<input type="radio" name="missingQuery" value="True"
						<?php if(isset($_POST['doSearch']) && isset($_POST['missingQuery']) && strcmp($_POST['missingQuery'], "True") == 0)
									echo 'checked="checked"'; ?>> Yes &nbsp
					<input type="radio" name="missingQuery" value="False"
						<?php if(isset($_POST['doSearch']) && isset($_POST['missingQuery']) && strcmp($_POST['missingQuery'], "False") == 0)
									echo 'checked="checked"'; ?>> No &nbsp
					<input type="radio" name="missingQuery" value=""
						<?php if(empty($_POST['missingQuery']))
									echo 'checked="checked"'; ?>> Either
				</td>
			</tr>
		</table>

		<table align="center">
			<tr><td></br></td><tr>
			<tr>
				<td style="padding-right: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">Submit</button>
					<input type="hidden" name="doBicycleSearch" value="1">
					<input type="hidden" name="doSearch" value="1">
				</td>
		</form>
		<form method="post">
				<td style="padding-left: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">Reset</button>
					<input type="hidden" name="doSearch" value="0">
				</td>
		</form>
			</tr>
		</table>
	</div>

	<div class="tab-pane fade" id="report-tab">
		<input type="hidden" name="reportSearch" value="1">
		<br/>
		<table align="center">
			<tr>
				<td>
					<b>Search for Reports by:</b>
					<br/>
				</td>
			</tr>
		<form method="post" action="admin.php">
			<tr>
				<td>
					Serial Number:
				</td>
				<td>
					<input CLASS="form-control" type="text" name="serialReportQuery" value="">
				 </td>
			</tr>
			<tr>
				<td>
					Return Method:
				</td>
				<td>
						<div class="col-lg-20"><select class="form-control" name="returnMethodQuery" id="ReturnMethod" onchange="DirectContact()">
							<option value="allMethods">All</option>
							<option value="security">Campus Security</option>
							<option value="parking">Campus Parking</option>
							<option value="police">Kingston Police</option>
							<option value="directContact">Direct Contact</option>
						</select></div>
				</td>
			</tr>
			<tr>
				<td>
					Date:
				</td>
				<td>
					<input CLASS="form-control" type="date" name="dateQuery" value="">
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<input type="radio" name="datePeriodQuery" value="1"
						<?php if(isset($_POST['doSearch']) && isset($_POST['datePeriodQuery']) && $_POST['datePeriodQuery'] == 1)
									echo 'checked="checked"'; ?>> After &nbsp
					<input type="radio" name="datePeriodQuery" value="2"
						<?php if(isset($_POST['doSearch']) && isset($_POST['datePeriodQuery']) && $_POST['datePeriodQuery']== 2)
									echo 'checked="checked"'; ?>> Before &nbsp
					<input type="radio" name="datePeriodQuery" value="0"
						<?php if(empty($_POST['datePeriodQuery']) OR (isset($_POST['datePeriodQuery']) && $_POST['datePeriodQuery']== 0))
									echo 'checked="checked"'; ?>> On
				</td>
			</tr>
		</table>

		<table align="center">
			<tr><td></br></td><tr>
			<tr>
				<td style="padding-right: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">Submit</button>
					<input type="hidden" name="doReportSearch" value="1">
					<input type="hidden" name="doSearch" value="1">
				</td>
		</form>
		<form method="post">
				<td style="padding-left: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">Reset</button>
					<input type="hidden" name="doSearch" value="0">
				</td>
		</form>
			</tr>
		</table>
	</div>

	<div class="tab-pane fade" id="user-tab">
		<input type="hidden" name="userSearch" value="1">
		<br/>
		<table align="center">
			<tr>
				<td>
					<b>Search for Users by:</b>
					<br/>
				</td>
			</tr>
		<form method="post" action="admin.php">
			<tr>
				<td>
					NetID:
				</td>
				<td>
					<input CLASS="form-control" type="text" name="netidQuery" value="">
				 </td>
			</tr>
			<tr>
				<td>
					Name:
				</td>
				<td>
					<input CLASS="form-control" type="text" name="nameQuery" value="">
				</td>
			</tr>
			<tr>
				<td>
					Admin:
				</td>
				<td>
					<input type="radio" name="adminQuery" value="1"
						<?php if(isset($_POST['doSearch']) && isset($_POST['adminQuery']) && $_POST['adminQuery'] == 1)
									echo 'checked="checked"'; ?>> Yes &nbsp
					<input type="radio" name="adminQuery" value="2"
						<?php if(isset($_POST['doSearch']) && isset($_POST['adminQuery']) && $_POST['adminQuery'] == 2)
									echo 'checked="checked"'; ?>> No &nbsp
					<input type="radio" name="adminQuery" value="0"
						<?php if(empty($_POST['adminQuery']) OR (isset($_POST['adminQuery']) && $_POST['adminQuery']== 0))
									echo 'checked="checked"'; ?>> Both
				</td>
			</tr>
		</table>

		<table align="center">
			<tr><td></br></td><tr>
			<tr>
				<td style="padding-right: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">Submit</button>
					<input type="hidden" name="doUserSearch" value="1">
					<input type="hidden" name="doSearch" value="1">
				</td>
		</form>
		<form method="post">
				<td style="padding-left: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">Reset</button>
					<input type="hidden" name="doSearch" value="0">
				</td>
		</form>
			</tr>
		</table>
	</div>
</div>
</section>


<aside>
<table>
<?php
	$result = search_missing($dbc);
	if (empty($result) == False) {
		echo "<tr><td>";
		echo '<ul style="list-style-type:none;padding:0;">';
		echo '<li><h4 style="margin-bottom:0.2em;">Missing Bicycles</h4></li>';
		echo '<div class="panel panel-default" style="border:1px solid black;padding:5px;height:80px;overflow: scroll;">';
		while($row = mysqli_fetch_assoc($result)) {
			echo "<li>".$row['Serial']."</li>";
		}
		echo "</ul>";
		echo "</div>";
		echo "</td></tr>";
	}
?>
	<tr>
		<td>
		<form method="link" action="./manage-admin.php">
			<button class="btn btn-primary" id="admin-button">Manage Administrators</button>
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
			<button class="btn btn-primary" id="admin-button">Generate Report</button>
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
	if (isset($_POST['doSearch']) AND $_POST['doSearch']) {
		if (isset($_POST['doBicycleSearch'])) {
			$result = search_bicycle($dbc, $_POST['serialQuery'],
												 $_POST['makeQuery'],
												 $_POST['modelQuery'],
												 $_POST['missingQuery']);
			if ($result != false && $result -> num_rows != 0) {
?>
				<h3 align="left">Bicycle Search Results</h3>
				<table class='table table-striped table-hover' id="admin-search">
					<tr>
						<th id="admin-th">Picture</th>
						<th id="admin-th">NetID</th>
						<th id="admin-th">Serial Number</th>
						<th id="admin-th">Make</th>
						<th id="admin-th">Model</th>
						<th id="admin-th">Missing</th>
					</tr>
<?php
				while($row = mysqli_fetch_assoc($result)){
					$missing = ($row['Missing'] == 0 ? "No" : "Yes");
					echo "<tr><td id='admin-search-td'><img height='75px' src=".$row['Image']."></td>
								<td id='admin-search-td'>".$row['NetID']."</td>
								<td id='admin-search-td'>".$row['Serial']."</td>
								<td id='admin-search-td'>".$row['Make']."</td>
								<td id='admin-search-td'>".$row['Model']."</td>
								<td id='admin-search-td'>".$missing."</td>
								</tr>";
				}
				echo "</table>";
			} else {
				echo "No bicycles could be found matching those criteria.";
			}
		} else if (isset($_POST['doReportSearch'])) {
			$result = search_report($dbc, $_POST['serialReportQuery'],
												 $_POST['returnMethodQuery'],
												 $_POST['dateQuery'],
												 $_POST['datePeriodQuery']);
			if ($result != false && $result -> num_rows != 0) {
?>
				<h3 align="left">Report Search Results</h3>
				<table class='table table-striped table-hover' id="admin-search">
					<tr>
						<th id="admin-th">Serial Number</th>
						<th id="admin-th">Date</th>
						<th id="admin-th">Time</th>
						<th id="admin-th">Location</th>
						<th id="admin-th">Description</th>
						<th id="admin-th">Return Location</th>
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
				echo "</table>";
			} else {
				echo "No reports could be found matching those criteria.";
			}
		} else if (isset($_POST['doUserSearch'])) {
			$result = search_user($dbc, $_POST['netidQuery'],
												 $_POST['nameQuery'],
												 $_POST['adminQuery']);
			if ($result != false && $result -> num_rows != 0) {
?>
				<h3 align="left">User Search Results</h3>
				<table class='table table-striped table-hover' id="admin-search">
					<tr>
						<th id="admin-th">NetID</th>
						<th id="admin-th">Name</th>
						<th id="admin-th">E-mail</th>
						<th id="admin-th">Phone</th>
						<th id="admin-th">Admin</th>
					</tr>
<?php
				while($row = mysqli_fetch_assoc($result)){
					$is_admin = ($row['Admin'] == 0 ? "No" : "Yes");
					echo "<tr>
								<td id='admin-search-td'>".$row['NetID']."</td>
								<td id='admin-search-td'>".$row['Name']."</td>
								<td id='admin-search-td'>".$row['Email']."</td>
								<td id='admin-search-td'>".$row['Phone']."</td>
								<td id='admin-search-td'>".$is_admin."</td>
								</tr>";
				}
				echo "</table>";
			} else {
				echo "No users could be found matching those criteria.";
			}
		}
	}
?>
</section>

</div>

<?php
	include_once '../includes/footer.php';
?>
