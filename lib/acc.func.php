<?php

/**
 * User account update function
 */

// Update Phone Number
function update_phone($netid, $phone){
	global $dbc;
	$sql = "UPDATE Users SET Phone = '$phone' WHERE NetID = '$netid'";

	$query = $dbc -> query($sql);
	if ($query){
		return true;
	}else{
		return false;
	}

}


// Update Admin - Add/Delete Admin
function update_admin($netid){
	global $dbc;
	$sql = "UPDATE Users SET Admin = '1' WHERE NetID = '$netid'";

	$query = $dbc -> query($sql);
	if ($query){
		return true;
	}else{
		return false;
	}
}

function delete_admin($netid){
	global $dbc;
	$sql = "UPDATE Users SET Admin = '0' WHERE NetID = '$netid'";

	$query = $dbc -> query($sql);
	if ($query){
		return true;
	}else{
		return false;
	}
}





?>