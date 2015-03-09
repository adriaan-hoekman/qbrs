<?php

/**
 * Bicycle Search functuons file to search Bicycle information.
 */
function search_serial_nonreg ($dbc, $serialNum) {
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

function search_serial($dbc, $serialNum) {
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

function search_model($dbc, $model) {
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

function search_make($dbc, $make) {
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

function search_netid($dbc, $netid) {
	$sql = "SELECT * FROM User, Bicycle WHERE User.NetID = '$netid' AND Bicycle.UserID = User.UserID AND Bicycle.Serial NOT LIKE '%DELETE%'";
	$query = $dbc -> query($sql);

	return $query;
}

function search_missing($dbc) {
	$sql = "SELECT Serial FROM Bicycle WHERE Missing > 0";
	$query = $dbc -> query($sql);

	return $query;
}

function search_bicycle($dbc, $serial, $make, $model, $missing) {
	$sql = "SELECT * FROM Bicycle, User
					WHERE Bicycle.UserID = User.UserID";
	if (empty($serial) == False) {
		$sql .= " AND Serial LIKE '%$serial%'";
	}
	if (empty($make) == False) {
		$sql .= " AND Make = '$make'";
	}
	if (empty($model) == False) {
		$sql .= " AND Model = '$model'";
	}
	if (empty($missing) == False) {
		if (strcmp($missing, "True") == 0) {
			$sql .= " AND Missing > 0";
		} else {
			$sql .= " AND Missing = 0";
		}
	}

	$query = $dbc -> query($sql);

	return $query;
}

function search_users($dbc, $user_role) {
	$sql = "SELECT * FROM User";
	switch ($user_role) {
		case 1:
			$sql .= " WHERE Admin > 0";
		case 2:
			$sql .= " WHERE Admin = 0";
		default:
			break;
	}

	$query = $dbc -> query($sql);

	return $query;
}

?>
