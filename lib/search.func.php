<?php

/**
 * Bicycle Search functuons file to search Bicycle information.
 */
function search_serial_nonreg ($dbc, $serialNum) {
	$serialNum = mysqli_real_escape_string($dbc, $serialNum);
	$sql = "SELECT * FROM Bicycle WHERE Serial = '$serialNum' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_assoc();

	if(empty($result)){
		// No Bicycle with this serial number in the database
		return 0;
	} else {
		// Bicycle is already in the database
		return $result;
	}
}

// Return the bicycle with the specified bicycle ID
function search_bicycle_id($dbc, $bicycleid) {
	$bicycleid = mysqli_real_escape_string($dbc, $bicycleid);
	$query = mysqli_query($dbc, "SELECT * FROM Bicycle WHERE BicycleID = '$bicycleid';");

	return $query;
}

// Return the bicycle with the specified serial number
function search_serial($dbc, $serialNum) {
	$serialNum = mysqli_real_escape_string($dbc, $serialNum);
	$sql = "SELECT * FROM Bicycle WHERE Serial = '$serialNum' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No Bicycle with this serial number in the database
		return 0;
	} else {
		// Bicycle is already in the database
		return 1;
	}
}

// Return a list of bicycles with the specified model
function search_model($dbc, $model) {
	$model = mysqli_real_escape_string($dbc, $model);
	$sql = "SELECT * FROM Bicycle WHERE Model = '$model' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No Bicycle with this model in the database
		return 0;
	} else {
		// Bicycle is already in the database
		return 1;
	}
}

// Return a list of bicycles with the specified make
function search_make($dbc, $make) {
	$make = mysqli_real_escape_string($dbc, $make);
	$sql = "SELECT * FROM Bicycle WHERE Make = '$make' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No Bicycle with this net ID in the database
		return 0;
	} else {
		// Bicycle is already in the database
		return $result;
	}
}

// Return the user with the specified netid
function search_netid($dbc, $netid) {
	$netid = mysqli_real_escape_string($dbc, $netid);
	$sql = "SELECT * FROM User, Bicycle WHERE User.NetID = '$netid' AND Bicycle.UserID = User.UserID AND Bicycle.Serial NOT LIKE '%DELETE%'";
	$query = $dbc -> query($sql);

	return $query;
}

// Return the list of all missing bicycles
function search_missing($dbc) {
	$sql = "SELECT Serial FROM Bicycle WHERE Missing > 0 AND Serial NOT LIKE '%DELETE%'";
	$query = $dbc -> query($sql);

	return $query;
}

// Return a list of bicycles based on the inputs from the bicycle tab on the admin page
function search_bicycle($dbc, $netid, $serial, $make, $model, $missing) {
	$sql = "SELECT * FROM Bicycle, User
					WHERE Bicycle.UserID = User.UserID
					AND SERIAL NOT LIKE '%DELETE%'";
	if (empty($netid) == False) {
		$netid = mysqli_real_escape_string($dbc, $netid);
		$sql .= " AND NetID LIKE '%$netid%'";
	}
	if (empty($serial) == False) {
		$serial = mysqli_real_escape_string($dbc, $serial);
		$sql .= " AND Serial LIKE '%$serial%'";
	}
	if (empty($make) == False) {
		$make = mysqli_real_escape_string($dbc, $make);
		$sql .= " AND Make LIKE '%$make%'";
	}
	if (empty($model) == False) {
		$model = mysqli_real_escape_string($dbc, $model);
		$sql .= " AND Model LIKE '%$model%'";
	}
	if (empty($missing) == False) {
		if (strcmp($missing, "True") == 0) {
			$sql .= " AND Missing > 0";
		} else {
			$sql .= " AND Missing = 0";
		}
	}
	$query = $dbc -> query($sql) or die ("<br />Couldn't execute query.");
	return $query;
}

// Return a list of reports based on the inputs from the report tab on the admin page
function search_report($dbc, $serial, $return_location, $report_type, $date, $period) {
	$sql = "SELECT * FROM Bicycle, Report
					WHERE Bicycle.BicycleID = Report.BicycleID";
	if (empty($serial) == False) {
		$serial = mysqli_real_escape_string($dbc, $serial);
		$sql .= " AND Bicycle.Serial LIKE '%$serial%'";
	}
	if (empty($return_method) == False) {
		$return_method = mysqli_real_escape_string($dbc, $return_method);
		$sql .= " AND ReturnLocation = '$return_method'";
	}
	if (empty($report_type) == False) {
		switch ($period) {
			case 1:
				$sql .= " AND NOT ReturnLocation > 0";
				break;
			case 2:
				$sql .= " AND ReturnLocation > 0";
				break;
		}
	}
	if (empty($date) == False AND isset($period) == True ) {
		$date = mysqli_real_escape_string($dbc, $date);
		switch ($period) {
		case 1:
			$sql .= " AND Date > '$date'";
			break;
		case 2:
			$sql .= " AND Date < '$date'";
			break;
		default:
			$sql .= " AND Date = '$date'";
		}
	}

	$query = $dbc -> query($sql);
	return $query;
}

// Return a list of users based on the inputs from the user tab on the admin page
function search_user($dbc, $netid, $name, $user_role) {
	$sql = "SELECT * FROM User WHERE NOT UserID = 0";

	if (empty($netid) == False) {
		$netid = mysqli_real_escape_string($dbc, $netid);
		$sql .= " AND NetID = '$netid'";
	}
	if (empty($name) == False) {
		$name = mysqli_real_escape_string($dbc, $name);
		$sql .= " AND Name LIKE '%$name%'";
	}
	if ($user_role > 0) {
		switch ($user_role) {
			case 1:
				$sql .= " AND Admin > 0";
				break;
			case 2:
				$sql .= " AND Admin = 0";
				break;
			default:
				break;
		}
	}

	$query = $dbc -> query($sql);
	return $query;
}

?>
