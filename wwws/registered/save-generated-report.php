<?php
	include_once '../../lib/global.conf.php';
	include_once '../../lib/admin.func.php';

	if(isset($_POST['export'])) {
		$result = report_to_csv($dbc, $_POST['export']);
		$_POST['submit'] = $_POST['export'];
	}
?>