<?php

// Function to check if the user is already in the database
function is_registered($dbc, $netid) {
	$sql = "SELECT * FROM User WHERE NetID = '$netid' AND NOT UserID = 0 limit 1";
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

// Function to check if the user is an admin
function is_admin($dbc, $netid) {
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

// Function to register new users in the database
function register_user($dbc, $netid, $name, $email, $da) {
	$result = mysqli_query($dbc,
		"INSERT INTO User (NetID, Name, Email, RegistrationDate)
		 VALUES ('$netid', '$name', '$email', '$da');")
		or die ("<br />Couldn't execute query.");
	return $result;
}

?>