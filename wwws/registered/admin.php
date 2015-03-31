<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/search.func.php';
	include_once '../../lib/admin.func.php';
?>

<div class="container" align='center'>
<section id="admin-basic">
</br>
<ul class="nav nav-tabs">
<?php
	if (isset($_POST['doBicycleSearch']) OR !isset($_POST['doSearch'])) {
		echo '<li class="active"><a href="#bicycle-tab" data-toggle="tab" aria-expanded="true">Bicycles</a></li>
					<li class=""><a href="#report-tab" data-toggle="tab" aria-expanded="false">Reports</a></li>
					<li class=""><a href="#user-tab" data-toggle="tab" aria-expanded="false">Users</a></li>';
	} else if (isset($_POST['doReportSearch'])){
		echo '<li class=""><a href="#bicycle-tab" data-toggle="tab" aria-expanded="true">Bicycles</a></li>
					<li class="active"><a href="#report-tab" data-toggle="tab" aria-expanded="false">Reports</a></li>
					<li class=""><a href="#user-tab" data-toggle="tab" aria-expanded="false">Users</a></li>';
	} else if (isset($_POST['doUserSearch'])){
		echo '<li class=""><a href="#bicycle-tab" data-toggle="tab" aria-expanded="true">Bicycles</a></li>
					<li class=""><a href="#report-tab" data-toggle="tab" aria-expanded="false">Reports</a></li>
					<li class="active"><a href="#user-tab" data-toggle="tab" aria-expanded="false">Users</a></li>';
	} else {
		echo '<li class="active"><a href="#bicycle-tab" data-toggle="tab" aria-expanded="true">Bicycles</a></li>
					<li class=""><a href="#report-tab" data-toggle="tab" aria-expanded="false">Reports</a></li>
					<li class=""><a href="#user-tab" data-toggle="tab" aria-expanded="false">Users</a></li>';
	}
?>
</ul>

<form method="post" action="admin.php">
<div id="myTabContent" class="tab-content">
<?php
	if (isset($_POST['doBicycleSearch']) OR !isset($_POST['doSearch'])) {
		echo '<div class="tab-pane fade active in" id="bicycle-tab">';
	} else {
		echo '<div class="tab-pane fade" id="bicycle-tab">';
	}
?>
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
					<b>NetID:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['bicycleNetidQuery'])) {
						echo '<input CLASS="form-control" type="text" name="bicycleNetidQuery" value="'.$_POST['bicycleNetidQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="bicycleNetidQuery" value="">';
					}
				?>
				 </td>
			</tr>
			<tr>
				<td>
					<b>Serial Number:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['serialQuery'])) {
						echo '<input CLASS="form-control" type="text" name="serialQuery" value="'.$_POST['serialQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="serialQuery" value="">';
					}
				?>
				 </td>
			</tr>
			<tr>
				<td>
					<b>Make:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['makeQuery'])) {
						echo '<input CLASS="form-control" type="text" name="makeQuery" value="'.$_POST['makeQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="makeQuery" value="">';
					}
				?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Model/Type:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['modelQuery'])) {
						echo '<input CLASS="form-control" type="text" name="modelQuery" value="'.$_POST['modelQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="modelQuery" value="">';
					}
				?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Missing:</b>
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
					<button class="btn btn-primary btn-sm" id="admin-button">
						<span class="glyphicon glyphicon-search"></span> Search
					</button>
					<input type="hidden" name="doBicycleSearch" value="1">
					<input type="hidden" name="doSearch" value="1">
				</td>
		</form>
		<form method="post">
				<td style="padding-left: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">
						<span class="glyphicon glyphicon-refresh"></span> Reset
					</button>
					<input type="hidden" name="doBicycleSearch" value="1">
					<input type="hidden" name="doSearch" value="0">
				</td>
		</form>
			</tr>
		</table>
	</div>
<?php
	if (isset($_POST['doReportSearch'])) {
		echo '<div class="tab-pane fade active in" id="report-tab">';
	} else {
		echo '<div class="tab-pane fade" id="report-tab">';
	}
?>
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
					<b>Serial Number:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['serialReportQuery'])) {
						echo '<input CLASS="form-control" type="text" name="serialReportQuery" value="'.$_POST['serialReportQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="serialReportQuery" value="">';
					}
				?>
				 </td>
			</tr>
			<tr>
				<td>
					<b>Return Method:</b>
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
					<b>Report Type:</b>
				</td>
				<td>
						<div class="col-lg-20"><select class="form-control" name="reportTypeQuery" id="ReportType" onchange="DirectContact()">
							<option value="0">All</option>
							<option value="1">Missing</option>
							<option value="2">Found</option>
						</select></div>
				</td>
			</tr>
			<tr>
				<td>
					<b>Date:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['dateQuery'])) {
						echo '<input CLASS="form-control" type="date" name="dateQuery" value="'.$_POST['dateQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="date" name="dateQuery" value="">';
					}
				?>
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
					<button class="btn btn-primary btn-sm" id="admin-button">
						<span class="glyphicon glyphicon-search"></span> Search
					</button>
					<input type="hidden" name="doReportSearch" value="1">
					<input type="hidden" name="doSearch" value="1">
				</td>
		</form>
		<form method="post">
				<td style="padding-left: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">
						<span class="glyphicon glyphicon-refresh"></span> Reset
					</button>
					<input type="hidden" name="doReportSearch" value="1">
					<input type="hidden" name="doSearch" value="0">
				</td>
		</form>
			</tr>
		</table>
	</div>
<?php
	if (isset($_POST['doUserSearch'])) {
		echo '<div class="tab-pane fade active in" id="user-tab">';
	} else {
		echo '<div class="tab-pane fade" id="user-tab">';
	}
?>
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
					<b>NetID:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['netidQuery'])) {
						echo '<input CLASS="form-control" type="text" name="netidQuery" value="'.$_POST['netidQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="netidQuery" value="">';
					}
				?>
			 </td>
			</tr>
			<tr>
				<td>
					<b>Name:</b>
				</td>
				<td>
				<?php
					if (isset($_POST['nameQuery'])) {
						echo '<input CLASS="form-control" type="text" name="nameQuery" value="'.$_POST['nameQuery'].'">';
					} else {
						echo '<input CLASS="form-control" type="text" name="nameQuery" value="">';
					}
				?>
				</td>
			</tr>
			<tr>
				<td>
					<b>Admin:</b>
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
					<button class="btn btn-primary btn-sm" id="admin-button">
						<span class="glyphicon glyphicon-search"></span> Search
					</button>
					<input type="hidden" name="doUserSearch" value="1">
					<input type="hidden" name="doSearch" value="1">
				</td>
		</form>
		<form method="post">
				<td style="padding-left: 5px">
					<button class="btn btn-primary btn-sm" id="admin-button">
						<span class="glyphicon glyphicon-refresh"></span> Reset
					</button>
					<input type="hidden" name="doUserSearch" value="1">
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
		<form method="link" action="./manage-admin.php">
			<button class="btn btn-primary" id="admin-button">Manage Administrators</button>
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
<?php
	if (isset($_POST['doSearch']) AND $_POST['doSearch']) {
		if (isset($_POST['doBicycleSearch'])) {
			$result = search_bicycle($dbc, $_POST['bicycleNetidQuery'],
																		$_POST['serialQuery'],
																		$_POST['makeQuery'],
																		$_POST['modelQuery'],
																		$_POST['missingQuery']);
			if ($result != false && $result -> num_rows != 0) {
				echo "<form method='post' action='./save-generated-report.php' target='_blank'>
								<h3 align='left'>Bicycle Search Results &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
																 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								<button class='btn btn-primary' id='admin-report-button' name='exportCustom' value='1'>
									<span class='glyphicon glyphicon-download-alt'></span> Download
								</button>
								</h3>
								<input type='hidden' name='bicycleNetidQuery' value='".$_POST['bicycleNetidQuery']."'>
								<input type='hidden' name='serialQuery' value='".$_POST['serialQuery']."'>
								<input type='hidden' name='makeQuery' value='".$_POST['makeQuery']."'>
								<input type='hidden' name='modelQuery' value='".$_POST['modelQuery']."'>
								<input type='hidden' name='missingQuery' value='".$_POST['missingQuery']."'>
							</form>";
			}
		} else if (isset($_POST['doReportSearch'])) {
			$result = search_report($dbc, $_POST['serialReportQuery'],
																 $_POST['returnMethodQuery'],
																 $_POST['reportTypeQuery'],
																 $_POST['dateQuery'],
																 $_POST['datePeriodQuery']);
			if ($result != false && $result -> num_rows != 0) {
				echo "<form method='post' action='./save-generated-report.php' target='_blank'>
								<h3 align='left'>Report Search Results &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
																 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								<button class='btn btn-primary' id='admin-report-button' name='exportCustom' value='2'>
									<span class='glyphicon glyphicon-download-alt'></span> Download
								</button>
								</h3>
								<input type='hidden' name='serialReportQuery' value='".$_POST['serialReportQuery']."'>
								<input type='hidden' name='returnMethodQuery' value='".$_POST['returnMethodQuery']."'>
								<input type='hidden' name='reportTypeQuery' value='".$_POST['reportTypeQuery']."'>
								<input type='hidden' name='dateQuery' value='".$_POST['dateQuery']."'>
								<input type='hidden' name='datePeriodQuery' value='".$_POST['datePeriodQuery']."'>
							</form>";
			}
		} else if (isset($_POST['doUserSearch'])) {
			$result = search_user($dbc, $_POST['netidQuery'],
															 $_POST['nameQuery'],
															 $_POST['adminQuery']);
			if ($result != false && $result -> num_rows != 0) {
				echo "<form method='post' action='./save-generated-report.php' target='_blank'>
								<h3 align='left'>User Search Results &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
																 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								<button class='btn btn-primary' id='admin-report-button' name='exportCustom' value='3'>
									<span class='glyphicon glyphicon-download-alt'></span> Download
								</button>
								</h3>
								<input type='hidden' name='netidQuery' value='".$_POST['netidQuery']."'>
								<input type='hidden' name='nameQuery' value='".$_POST['nameQuery']."'>
								<input type='hidden' name='adminQuery' value='".$_POST['adminQuery']."'>
							</form>";
			}
		}

		if (isset($_POST['doBicycleSearch'])) {
			if ($result != false && $result -> num_rows != 0) {
?>
				<table class='table table-striped table-hover' id="admin-search">
					<tr>
						<th id="admin-th">Picture</th>
						<th id="admin-th">NetID</th>
						<th id="admin-th">Serial Number</th>
						<th id="admin-th">Make</th>
						<th id="admin-th">Model/Type</th>
						<th id="admin-th">Missing</th>
					</tr>
<?php
				while ($row = mysqli_fetch_assoc($result)){
					if ($row['UserID'] !== 0) {
						$missing = ($row['Missing'] == 0 ? "No" : "Yes");
						if (empty($row['Image'])) {
							echo "<tr><td id='admin-search-td'><img height='75px' src='../images/default_bicycle.png'></td>";
						} else {
							echo "<tr><td id='admin-search-td'><img height='75px' src=".$row['Image']."></td>";
						}
							echo "<td id='admin-search-td'>".$row['NetID']."</td>
										<td id='admin-search-td'>".$row['Serial']."</td>
										<td id='admin-search-td'>".$row['Make']."</td>
										<td id='admin-search-td'>".$row['Model']."</td>
										<td id='admin-search-td'>".$missing."</td>
										</tr>";
					}
				}
				echo "</table>";
			} else {
				echo "No bicycles could be found matching those criteria.";
			}
		} else if (isset($_POST['doReportSearch'])) {
			if ($result != false && $result -> num_rows != 0) {
?>
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
				while ($row = mysqli_fetch_assoc($result)){
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
			if ($result != false && $result -> num_rows != 0) {
?>
				<table class='table table-striped table-hover' id="admin-search">
					<tr>
						<th id="admin-th">NetID</th>
						<th id="admin-th">Name</th>
						<th id="admin-th">E-mail</th>
						<th id="admin-th">Phone</th>
						<th id="admin-th">Admin</th>
					</tr>
<?php
				while ($row = mysqli_fetch_assoc($result)){
					if ($row['UserID'] !== 0) {
						$is_admin = ($row['Admin'] == 0 ? "No" : "Yes");
						echo "<tr>
									<td id='admin-search-td'>".$row['NetID']."</td>
									<td id='admin-search-td'>".$row['Name']."</td>
									<td id='admin-search-td'>".$row['Email']."</td>
									<td id='admin-search-td'>".$row['Phone']."</td>
									<td id='admin-search-td'>".$is_admin."</td>
									</tr>";
					}
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
