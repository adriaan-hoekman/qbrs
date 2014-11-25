<?php

/**
 * User checking function see if the user are already in database
 */

function is_registered($dbc, $netid) {
	$sql = "SELECT * FROM Users WHERE NetID = '$netid' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No User with this net ID in the database
		return 0;
	} else {
		// User is already in the database
		return 1;
	}
}

function is_admin($dbc, $netid) {
	$sql = "SELECT * FROM Users WHERE NetID = '$netid' AND Admin > 0 limit 1";
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

function register_user($dbc, $netid, $name, $email, $da) {
	$result = mysqli_query($dbc,
		"INSERT INTO Users (NetID, Name, Email, RegistrationDate)
		 VALUES ('$netid', '$name', '$email', '$da');")
		or die ("<br />Couldn't execute query.");
	return $result;
}

?>