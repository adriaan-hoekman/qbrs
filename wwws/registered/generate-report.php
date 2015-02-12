<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/reg.func.php';
	include_once '../../lib/admin.func.php';
?>

<nav>
<h1>GENERATE REPORT</h1>
</nav>

<section id="admin-basic">
</section>

<aside>
<table align="center">
	<tr>
		<?php
		echo "<td>";
		echo '<FORM METHOD="LINK" ACTION="./admin.php">';
		echo '<INPUT TYPE="submit" VALUE="Admin Home">';
		echo "</FORM>";
		echo "</td>";   
		?>
	</tr>
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
		echo '<FORM METHOD="LINK" ACTION="./manage-admin.php">';
		echo '<INPUT TYPE="submit" VALUE="Manage Administrators">';
		echo "</FORM>";
		echo "</td>";   
		?>
	</tr>
</table>
</aside>

<?php
	include_once '../includes/footer.php';
?>