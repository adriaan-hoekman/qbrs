<?php

function add_admin($dbc, $netid) {
	$sql = "UPDATE User SET Admin = 1 WHERE NetID = '$netid'";
	if ($dbc -> query($sql) === TRUE) {
		return 1;
	} else {
		return 0;
	}
}

function remove_admin($dbc, $netid) {
	$sql = "UPDATE User SET Admin = 0 WHERE NetID = '$netid'";

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
			return "Recovered Bicycles";
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
						WHERE Bicycle.UserID = User.UserID";
	} else if ($report_type == 2) {
		return "SELECT NetID, Serial, Make, Model, Missing, Other
						FROM Bicycle, User
						WHERE Bicycle.UserID = User.UserID AND missing > 0";
	} else if ($report_type == 3) {
		return "SELECT NetID, Serial, Make, Model, Missing, Other
						FROM Bicycle, User
						WHERE Bicycle.UserID = User.UserID AND missing = 0";
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
		if ($report_type > 3 && $report_type < 7) {
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

?>