<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/search.func.php';
?>

<nav>
<h3 align="center">ADMINISTRATOR</h1>
</nav>

<div class="container" align='center'>
<section id="admin-basic">
<table align="center">
	<tr>
		<td>
			<?php
			date_default_timezone_set("America/Toronto");

			$netid = $_SERVER['HTTP_QUEENSU_NETID'];
			$name = $_SERVER['HTTP_COMMON_NAME'];
			$email = $_SERVER['HTTP_QUEENSU_MAIL'];
			$da = date("Y-m-d H:i:s");

			echo "<b>Search for bicycles by:</b>";
			echo "<br />";
			?>
		</td>
	</tr>
<form method="post" action="admin.php">
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
	<tr><td></br></td><tr>
	<tr>
		<td style="padding-right: 5px">
			<button class="btn btn-primary btn-sm" id="admin-button">Submit</button>
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
</table>
</aside>

<section id="admin-results">
<?php
	if(isset($_POST['doSearch']) AND $_POST['doSearch']) {
		$result = search_bicycle($dbc, $_POST['serialQuery'],
								       $_POST['makeQuery'],
								       $_POST['modelQuery'],
								       $_POST['missingQuery']);
		if ($result != false && $result -> num_rows != 0) {
?>
		<table class='table table-striped table-hover' id="admin-search" align="center">
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
	}
?>
</section>

</div>

<?php
	include_once '../includes/footer.php';
?>
