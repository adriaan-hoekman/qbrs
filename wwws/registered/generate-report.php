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
		<td>
		<FORM METHOD="LINK" ACTION="./admin.php">
		<button id="admin-button">Admin Home</button>
		</FORM>
		</td>
	</tr>
	<tr>
		<td>
		<FORM METHOD="LINK" ACTION="./home.php">
		<button id="admin-button">Manage Personal Bicycles</button>
		</FORM>
		</td>
	</tr>
	<tr>
		<td>
		<FORM METHOD="LINK" ACTION="./manage-admin.php">
		<button id="admin-button">Manage Administrators</button>
		</FORM>
		</td> 
	</tr>
</table>
</aside>

<?php
	include_once '../includes/footer.php';
?>