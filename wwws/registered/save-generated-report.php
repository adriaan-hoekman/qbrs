<?php
	include_once '../../lib/global.conf.php';
	include_once '../../lib/admin.func.php';
	include_once '../../lib/search.func.php';

	if(isset($_POST['exportCustom'])) {
		switch($_POST['exportCustom']) {
			case 1:
				$query = search_bicycle($dbc, $_POST['serialQuery'],
																			$_POST['makeQuery'],
																			$_POST['modelQuery'],
																			$_POST['missingQuery']);
				break;
			case 2:
				$query = search_report($dbc, $_POST['serialReportQuery'],
																		 $_POST['returnMethodQuery'],
																		 $_POST['reportTypeQuery'],
																		 $_POST['dateQuery'],
																		 $_POST['datePeriodQuery']);
				break;
			case 3:
				$query = search_user($dbc, $_POST['netidQuery'],
																	 $_POST['nameQuery'],
																	 $_POST['adminQuery']);
				break;
			default:
				$query = 0;
		}
		$result = custom_report_to_csv($dbc, $_POST['exportCustom'], $query);
		$_POST['submit'] = $_POST['exportCustom'];
	} else if(isset($_POST['export'])) {
		$result = report_to_csv($dbc, $_POST['export']);
		$_POST['submit'] = $_POST['export'];
	}
?>