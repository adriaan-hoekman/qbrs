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

?>