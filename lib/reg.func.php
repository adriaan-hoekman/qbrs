<?php

/*
|--------------------------------------------------------------------------
| User Management function file.
|--------------------------------------------------------------------------
|
| This file contain all function that handle user management
| This is used to check if user is already in the database,
| and if the user is admin,
| and register user.
|
*/

/**
 * Function to check if the user is already in the database.
 * 
 * @param  $netid, User's Net ID.
 * 
 * @return Bool, 0 or 1 indicate Fail or Success.
 */

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


/**
 * Function to check if the user is an admin
 * 
 * @param  $netid, User's Net ID
 * 
 * @return Bool, 0 or 1 indicate Fail or Success. 
 */

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

/**
 * Function to register new users in the database.
 * 
 * @param  User's Information, Net ID, Name, Email, and register date (Current Server Time)
 * 
 * @return Bool, Fail or Success
 */

function register_user($dbc, $netid, $name, $email, $da) {
	$result = mysqli_query($dbc,
		"INSERT INTO User (NetID, Name, Email, RegistrationDate)
		 VALUES ('$netid', '$name', '$email', '$da');")
		or die ("<br />Couldn't execute query.");
	return $result;
}

?>