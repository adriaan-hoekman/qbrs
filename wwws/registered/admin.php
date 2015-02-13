<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/search.func.php';
?>

<body>
<nav>
<h1>ADMINISTRATOR</h1>
</nav>

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

    		echo "Search for bicycles by:";
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
			<input type="text" name="serialQuery" value="">
		 </td>
    </tr>
    <tr>
		<td>
			Make:
		 </td>
		 <td>
			<input type="text" name="makeQuery" value="">
		 </td>
    </tr>
    <tr>
		<td>
			Model:
		 </td>
		 <td>
			<input type="text" name="modelQuery" value="">
		 </td>
    </tr>
    <tr>
		<td>
			Missing:
		 </td>
		 <td>
			<input type="radio" name="missingQuery" value="True" 
				<?php if(isset($_POST['doSearch']) && isset($_POST['missingQuery']) && strcmp($_POST['missingQuery'], "True") == 0)
						 	echo 'checked="checked"'; ?>>Yes
			<input type="radio" name="missingQuery" value="False" 
				<?php if(isset($_POST['doSearch']) && isset($_POST['missingQuery']) && strcmp($_POST['missingQuery'], "False") == 0)
						 	echo 'checked="checked"'; ?>>No
			<input type="radio" name="missingQuery" value="" 
				<?php if(empty($_POST['missingQuery']))
						 	echo 'checked="checked"'; ?>>Either
		 </td>
    </tr>
    <tr>
		<td>
			<input type="submit" name="submit" value="Submit">
			<input type="hidden" name="doSearch" value="1">
		 </td>
		 </form>
		 <form>
		 <td>
			<input type="submit" name="clear" value="Clear"> 
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
			echo '<div style="border:1px solid black;padding:5px;height:80px;overflow: scroll;">';
			foreach($result as $var) {
				echo "<li>".$var."</li>";
			}
			echo "</ul>";
			echo "</div>";
			echo "</td></tr>";
		 }
	?>
	<tr>
		<?php
		echo "<td>";
		echo '<FORM METHOD="LINK" ACTION="./home.php">';
		echo '<INPUT TYPE="submit" VALUE="Manage Personal Bicycles">';
		echo "</FORM>";
		echo "</td>";   
		?>
	</tr>
	<tr>
		<?php
		echo "<td>";
		echo '<FORM METHOD="LINK" ACTION="./home.php">';
		echo '<INPUT TYPE="submit" VALUE="Generate System Report">';
		echo "</FORM>";
		echo "</td>";   
		?>
	</tr>
	<tr>
		<?php
		echo "<td>";
		echo '<FORM METHOD="LINK" ACTION="./home.php">';
		echo '<INPUT TYPE="submit" VALUE="Manage Adminstrators">';
		echo "</FORM>";
		echo "</td>";   
		?>
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
		<table id="admin-search" align="center">
			<tr>
				<th id="admin-th">Picture</th>
				<th id="admin-th">Serial Number</th>
				<th id="admin-th">Make</th>
				<th id="admin-th">Model</th>		
				<th id="admin-th">Missing</th>
			</tr>
<?php
			while($row = mysqli_fetch_assoc($result)){
				$missing = ($row['Missing'] == 0 ? "No" : "Yes");
				echo "<tr><td id='admin-search-td'>".$row['Image']."</td>
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
</body>

<?php
	include_once '../includes/footer.php';
?>
