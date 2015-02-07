<?php

/**
 * Bicycle Search functuons file to search Bicycle information.
 */

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
		return 1;
	}
}

function search_netid($dbc, $netid) {
	$sql = "SELECT * FROM Users, Bicycle WHERE NetID = '$netid' AND Bicycle.UserID = User.UserID";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No Bicycle with this net ID in the database
		return 0;
	} else {
		// Bicycle is already in the database
		return 1;
	}
}

function search_missing($dbc) {
	$sql = "SELECT Serial FROM Bicycle WHERE Missing > 0";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_assoc();
	
	return $result;
}

function search_bicycle($dbc, $serial, $make, $model, $missing) {
	$sql = "SELECT * FROM Bicycle WHERE ";
	if (empty($serial) == False) {
		$sql .= "Serial = '$serial'";
	}
	if (empty($make) == False) {
		if (empty($serial) == False) {
			$sql .= " AND ";
		}
		$sql .= "Make = '$make'";
	}
	if (empty($model) == False) {
		if (empty($serial) == False or empty($make) == False) {
			$sql .= " AND ";
		}
		$sql .= "Model = '$model'";
	}
	if (empty($missing) == False) {
		if (empty($serial) == False or empty($make) == False or empty($model) == False) {
			$sql .= " AND ";
		}
		if (strcmp($missing, "True") == 0) {
			$sql .= "Missing > 0";
		} else {
			$sql .= "Missing = 0";
		}
	}
	if (empty($serial) and empty($make) and empty($model) and empty($missing)) {
		$sql = "SELECT * FROM Bicycle";
	} 
	$query = $dbc -> query($sql);
	
	return $query;
}

?>