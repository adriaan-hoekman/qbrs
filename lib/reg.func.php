<?php

/**
 * User checking function see if the user are already in database
 */

// Check if User already in Database
function is_registered($netid){
	global $dbc;
	$sql = "SELECT * FROM Users WHERE NetID = '$netid' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No User with this net ID in the database
		return 1;
	}else{
		// User is already in the database
		return 0;
	}
}

// Check if User is Admin
function is_admin($netid){
	global $dbc;

	$sql = "SELECT * FROM Users WHERE NetID = '$netid' AND Admin = '1'";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// Not Admin
		return 1;
	}else{
		// Admin
		return 0;
	}
}

// Register Account.
function reg($netid, $name, $email, $date){
	global $dbc;
	$sql = "INSERT INTO Users (NetID, Name, Email, RegistrationDate) VALUES ('$netid', '$name', '$email', '$da')";
	$query = $dbc -> query($sql);
	if($query){
		return 1;
	}else{
		return 0;
	}

}

?>