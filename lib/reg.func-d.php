<?php

/**
 * User checking function see if the user are already in database
 */

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