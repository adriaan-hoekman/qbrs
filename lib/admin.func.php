<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];

function admin_redirect($dbc, $netid) {
	$sql = "SELECT * FROM User WHERE NetID = '$netid' AND Admin > 0 limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// User is not an admin
		return 0;
	} else {
		// User is an admin
		return 1;
	}
}

if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))
		OR admin_redirect($dbc, $_SERVER['HTTP_QUEENSU_NETID']) == 0) {
			flush();
			ob_flush();
			session_write_close();
?>
	<script language="JavaScript">
		window.location.href = './home.php';
	</script>
<?php
}

function add_admin($dbc, $netid) {
	$netid = mysqli_real_escape_string($dbc, $netid);
	$sql = "Select * FROM User WHERE NetID = '$netid'";
	$query = $dbc -> query($sql);
	if ($query === FALSE) {
		return 0;
	} else {
		$result = $query -> fetch_array();
		if (empty($result) OR $result['Admin'] == 1) {
			return 0;
		}
	}

	$sql = "UPDATE User SET Admin = 1 WHERE NetID = '$netid'";
	if ($dbc -> query($sql) === TRUE) {
		return 1;
	} else {
		return 0;
	}
}

function remove_admin($dbc, $netid) {
	$netid = mysqli_real_escape_string($dbc, $netid);
	if ($netid == $_SERVER['HTTP_QUEENSU_NETID']) {
		return 0;
	}

	$sql = "Select * FROM User WHERE NetID = '$netid'";
	$query = $dbc -> query($sql);
	if ($query === FALSE) {
		return 0;
	} else {
		$result = $query -> fetch_array();
		if (empty($result) OR $result['Admin'] == 1) {
			return 0;
		}
	}

	$sql = "UPDATE User SET Admin = 0 WHERE NetID = '$netid'";

	if ($dbc -> query($sql) === TRUE) {
		return 1;
	} else {
		return 0;
	}
}

function get_get_email($dbc, $netid) {
	$sql = "SELECT GetEmail
					FROM User
					WHERE NetID = '$netid'";
	$result = mysqli_query($dbc, $sql) -> fetch_assoc();
	$var = $result['GetEmail'];
	if ($var == 0) {
		return 0;
	} else {
		return 1;
	}
}

function set_get_email($dbc, $netid, $get_email) {
	$sql = "SELECT * FROM User WHERE Admin = 1 AND GetEmail = 1";
	$result = $dbc -> query($sql);
	if (($result -> num_rows) <= 1) {
		return 0;
	}

	$sql = "UPDATE User SET GetEmail = '$get_email' WHERE NetID = '$netid'";
	if ($dbc -> query($sql) === TRUE) {
		return 1;
	} else {
		return 0;
	}
}

function get_report_location($loc) {
	switch ($loc) {
		case 1:
			return "Campus Security";
		case 2:
			return "Parking";
		case 3:
			return "Kingston Police";
		default:
			return "----";
	}
}

function get_report_name($report_type) {
	switch ($report_type) {
		case 1:
			return "All Bicycles";
		case 2:
			return "Missing Bicycles";
		case 3:
			return "Not Missing Bicycles";
		case 4:
			return "All Reports";
		case 5:
			return "Missing Reports";
		case 6:
			return "Found Reports";
		case 7:
			return "All Users";
		case 8:
			return "Admins Only";
		case 9:
			return "Cyclists Only";
		default:
			return "----";
	}
}

function get_report_sql($report_type) {
	if ($report_type == 1) {
		return "SELECT NetID, Serial, Make, Model, Missing, Other
						FROM Bicycle, User
						WHERE Bicycle.UserID = User.UserID AND Serial NOT LIKE '%DELETE%'";
	} else if ($report_type == 2) {
		return "SELECT NetID, Serial, Make, Model, Missing, Other
						FROM Bicycle, User
						WHERE Bicycle.UserID = User.UserID AND missing > 0 AND Serial NOT LIKE '%DELETE%'";
	} else if ($report_type == 3) {
		return "SELECT NetID, Serial, Make, Model, Missing, Other
						FROM Bicycle, User
						WHERE Bicycle.UserID = User.UserID AND missing = 0 AND Serial NOT LIKE '%DELETE%'";
	} else if ($report_type == 4) {
		return "SELECT Serial, Date, Time, Location, Description, ReturnLocation
						FROM Report, Bicycle
						WHERE Report.BicycleID = Bicycle.BicycleID";
	} else if ($report_type == 5) {
		return "SELECT Serial, Date, Time, Location, Description, ReturnLocation
						FROM Report, Bicycle
						WHERE Report.BicycleID = Bicycle.BicycleID AND ReturnLocation = 0";
	} else if ($report_type == 6) {
		return "SELECT Serial, Date, Time, Location, Description, ReturnLocation
						FROM Report, Bicycle
						WHERE Report.BicycleID = Bicycle.BicycleID AND ReturnLocation > 0";
	} else if ($report_type == 7) {
		return "SELECT NetID, Name, Email, Phone, Admin
						FROM User";
	} else if ($report_type == 8) {
		return "SELECT NetID, Name, Email, Phone, Admin
						FROM User
						WHERE Admin > 0";
	} else if ($report_type == 9) {
		return "SELECT NetID, Name, Email, Phone, Admin
						FROM User
						WHERE Admin = 0";
	} else {
		return 0;
	}
}

function generate_report_filename($report_type) {
	if ($report_type == 1) {
		return "all-bicycles-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 2) {
		return "missing-bicycles-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 3) {
		return "found-bicycles-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 4) {
		return "all-reports-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 5) {
		return "mising-reports-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 6) {
		return "found-reports-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 7) {
		return "all-users-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 8) {
		return "admin-users-".date("Y-m-d-H-i-s").".csv";
	} else if ($report_type == 9) {
		return "cyclist-users-".date("Y-m-d-H-i-s").".csv";
	} else {
		return 0;
	}
}

function generate_report($dbc, $report_type) {
	$sql = get_report_sql($report_type);
	if ($sql === 0) {
		return 0;
	}

	$query = $dbc -> query($sql) or die(mysql_error($dbc));

	return $query;
}

function report_to_csv($dbc, $report_type, $attachment = True, $headers = True) {
		$filename = generate_report_filename($report_type);
		$query = generate_report($dbc, $report_type);

	if ($filename === 0 || $query === 0) {
		return 0;
	}

	if($attachment) {
		// send response headers to the browser
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$filename);
		$fp = fopen('php://output', 'w');
	} else {
		$fp = fopen($filename, 'w');
	}

	if($headers) {
		// output header row (if at least one row exists)
		$row = $query -> fetch_assoc();
		if($row) {
			fputcsv($fp, array_keys($row));
			// reset pointer back to beginning
			$query -> data_seek(0);
		}
	}

	while($row = $query -> fetch_assoc()) {
		if ($report_type < 3) {
			$row['Missing'] = ($row['Missing'] == 0 ? "No" : "Yes");
		} else if ($report_type > 3 && $report_type < 7) {
			$row['ReturnLocation'] = ($row['ReturnLocation'] == 0 ? "----" : $row['ReturnLocation']);
		} else if ($report_type > 6) {
			$row['Phone'] = ($row['Phone'] == Null ? "----" : $row['Phone']);
			$row['Admin'] = ($row['Admin'] == 0 ? "No" : "Yes");
		}
		fputcsv($fp, $row);
	}

	fclose($fp);

	return 1;
}

function custom_report_to_csv($dbc, $report_type, $query, $attachment = True, $headers = True) {
	switch ($report_type) {
		case 1:
			$filename = "custom-bicycles-".date("Y-m-d-H-i-s").".csv";
			break;
		case 2:
			$filename = "custom-reports-".date("Y-m-d-H-i-s").".csv";
			break;
		case 3:
			$filename = "custom-users-".date("Y-m-d-H-i-s").".csv";
			break;
		default:
			$filename = "custom-search-".date("Y-m-d-H-i-s").".csv";
	}

	if ($filename === 0 || $query === 0) {
		return 0;
	}

	if($attachment) {
		// send response headers to the browser
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$filename);
		$fp = fopen('php://output', 'w');
	} else {
		$fp = fopen($filename, 'w');
	}

	if($headers) {
		// output header row (if at least one row exists)
		$row = $query -> fetch_assoc();
		if($row) {
			fputcsv($fp, array_keys($row));
			// reset pointer back to beginning
			$query -> data_seek(0);
		}
	}

	while($row = $query -> fetch_assoc()) {
		if ($report_type == 1) {
			$row['Missing'] = ($row['Missing'] == 0 ? "No" : "Yes");
		} else if ($report_type == 2) {
			$row['ReturnLocation'] = ($row['ReturnLocation'] == 0 ? "----" : $row['ReturnLocation']);
		} else if ($report_type == 3) {
			$row['Phone'] = ($row['Phone'] == Null ? "----" : $row['Phone']);
			$row['Admin'] = ($row['Admin'] == 0 ? "No" : "Yes");
		}
		fputcsv($fp, $row);
	}

	fclose($fp);

	return 1;
}

?>